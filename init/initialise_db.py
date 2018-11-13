import collections
import json
import os
from pprint import pprint
import psycopg2
import re

# Get the details for a particular CVE and store it in a tuple
def getCveInfo(cveItem):
  Cve = collections.namedtuple('Cve', ['vendor_data', 'vendor', 'products', 'id', 'severity', 'description'])
  
  cve = cveItem["cve"]
  cveId = cve["CVE_data_meta"]["ID"]

  vendor_data = cve["affects"]["vendor"]["vendor_data"]
  vendor = ""
  products = ""
  if vendor_data:
    vendor_data = vendor_data[0]
    vendor = vendor_data["vendor_name"]
    products = vendor_data["product"]["product_data"]

  cveSeverity = cveItem["impact"]
  if 'baseMetricV2' in cveSeverity:
    cveSeverity = cveSeverity["baseMetricV2"]["severity"]
  if 'baseMetricV3' in cveSeverity:
    cveSeverity = cveSeverity["baseMetricV3"]["severity"]

  description = cve["description"]
  if cve["description"]:
    description = description["description_data"][0]["value"]

  return Cve(vendor_data, vendor, products, cveId, cveSeverity, description)

# Get the details for a particular product and store it in a tuple
def getProductInfo(cve, productItem):
  Product = collections.namedtuple('Product', ['model', 'version'])

  product_name = productItem["product_name"]
  product_model = cve.vendor + " " + product_name
  product_version = productItem["version"]["version_data"][0]["version_value"]

  return Product(product_model, product_version)

# Check if the current CVE and product conforms to the specifications in the schema
def doesNotConformToSpecs(cve, product):
  return len(product.model) > 150 or len(product.version) > 20 or len(cve.id) > 16 or len(cve.severity) > 6 or len(cve.description) > 500

# Print a series of debugging statements given a product and its corresponding cve
def printDebugStatements(cve, product):
  print("Product: " + product.model)
  print("Version: " + product.version)
  print("Cve id: " + cve.id)
  print("Severity: " + cve.severity)
  print("Description: " + cve.description)
  print("\n")

# Insert product and cve details into the database
def insert(cursor, product, cve):
  query = "INSERT INTO cve VALUES (%s, %s, %s, %s, %s)"
  cursor.execute(query, (product.model, product.version, cve.id, cve.severity, cve.description))
  print("Product and cve are inserted successfully! :)\n")

# Update cve details for a product existing in the database
def update(cursor, product, cve):
  query = "UPDATE cve SET cve_severity = %s, cve_description = %s WHERE router_model = %s AND router_version = %s AND cve_id = %s"
  cursor.execute(query, (cve.severity, cve.description, product.model, product.version, cve.id))
  print("Product and cve are updated successfully! :)\n")

# Check if a given pair of product and cve already exists in the database
def isFoundInDatabase(cursor, product, cve):
  query = "SELECT FROM cve WHERE router_model = %s AND router_version = %s AND cve_id = %s"
  cursor.execute(query, (product.model, product.version, cve.id))
  entry = cursor.fetchone()
  return type(entry) is not None

def main():
  # Connect to an existing database
  conn = psycopg2.connect("host=localhost port=5432 dbname=adap user=postgres password=123")

  # Open a cursor to perform database operations
  cursor = conn.cursor()

  # Create tables according to the schema
  cursor.execute(open("sql/schema.sql", "r").read())

  # Create dummy account and data
  cursor.execute(open("sql/company_account.sql", "r").read())
  cursor.execute(open("sql/router.sql", "r").read())
  cursor.execute(open("sql/admin.sql", "r").read())

  # Parse JSON files from https://nvd.nist.gov/vuln/data-feeds#JSON_FEED
  directory = "json"
  for filename in os.listdir(directory):

    # Settle the initial insertions first
    if filename.endswith(".json") and "modified" not in filename and "recent" not in filename:
      filename = os.path.join(directory, filename)
      data = json.load(open(filename))

      cveList = data["CVE_Items"]
      for cveItem in cveList:
        try:
          cve = getCveInfo(cveItem)

          # Skip the insertion if there is no vendor data
          if not cve.vendor_data:
            continue
        
          for productItem in cve.products:
            product = getProductInfo(cve, productItem)

            # Unlikely to be router if the details do not conform to our specs
            if (doesNotConformToSpecs(cve, product)):
              continue

            printDebugStatements(cve, product)
            insert(cursor, product, cve)

        except (Exception, psycopg2.DatabaseError) as error:
          print(error)
          break
      
  # Update entries modified and added recently
  # Do another 'for' loop to control the order of insertions
  for filename in os.listdir(directory):
    if filename.endswith(".json") and ("modified" in filename or "recent" in filename):
      filename = os.path.join(directory, filename)
      data = json.load(open(filename))

      cveList = data["CVE_Items"]
      for cveItem in cveList:
        try:
          cve = getCveInfo(cveItem)

          if not cve.vendor_data:
            continue
        
          for productItem in cve.products:
            product = getProductInfo(cve, productItem)

            # Unlikely to be router if the details do not conform to our specs
            if (doesNotConformToSpecs(cve, product)):
              continue

            printDebugStatements(cve, product)
            
            # Update the entry if it exists in the database, and insert the entry otherwise
            if (isFoundInDatabase(cursor, product, cve)):
              update(cursor, product, cve)
            else:
              insert(cursor, product, cve)
          
        except (Exception, psycopg2.DatabaseError) as error:
          print(error)
          break

  # Make the changes to the database persistent
  conn.commit()

  # Close communication with the database
  cursor.close()
  conn.close()

# Execute the program
if __name__ == "__main__":
  main()
