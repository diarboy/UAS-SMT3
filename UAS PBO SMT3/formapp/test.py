import mysql.connector

def test_connection():
    conn = mysql.connector.connect(
        host="localhost",
        user="root",
        password="",
        database="contact_form"
    )
    if conn.is_connected():
        print("Connected to MySQL database")
    conn.close()

test_connection()
