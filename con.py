import mysql.connector
from mysql.connector import Error

# Database connection details
host = "localhost"    # Database host (localhost)
port = "3307"          # Adjust port if necessary
username = "root"      # Database username
password = ""          # Database password
database = "userdb"    # Database name

def connect_to_database():
    try:
        # Establish the connection to the database
        connection = mysql.connector.connect(
            host=host,
            port=port,
            user=username,
            password=password,
            database=database
        )
        if connection.is_connected():
            print("Connected to the database")
            return connection
    except Error as e:
        print(f"Error: {e}")
        return None

def insert_data_into_db(connection, name, email, contact, address, pincode, date):
    try:
        # Create a cursor object to execute queries
        cursor = connection.cursor()

        # SQL query to insert data into the table
        query = """
        INSERT INTO customerinfo (name, email, contact, address, pincode, date) 
        VALUES (%s, %s, %s, %s, %s, %s)
        """
        # Data to be inserted
        data = (name, email, contact, address, pincode, date)

        # Execute the query
        cursor.execute(query, data)
        connection.commit()  # Commit the transaction
        print("Data inserted successfully!")

    except Error as e:
        print(f"Error inserting data: {e}")
        connection.rollback()  # Rollback in case of error

def main():
    # Connect to the database
    connection = connect_to_database()
    
    if connection:
        # Data to insert (Replace these values with form input)
        name = "John Doe"
        email = "john.doe@example.com"
        contact = "1234567890"
        address = "123 Main St"
        pincode = "123456"
        date = "2025-01-04"
        
        # Insert the data into the database
        insert_data_into_db(connection, name, email, contact, address, pincode, date)
        
        # Close the database connection
        connection.close()

if __name__ == "__main__":
    main()
