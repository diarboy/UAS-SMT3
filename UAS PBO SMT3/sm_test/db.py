import bcrypt
import mysql.connector

class DBConnection:
    def __init__(self):
        self.conn = mysql.connector.connect(
            host='localhost',
            user='root',  # Ganti dengan username MySQL Anda
            password='',  # Ganti dengan password MySQL Anda
            database='contact_form'
        )
        self.cursor = self.conn.cursor()

    def check_user_exists(self, username, email):
        query = "SELECT * FROM tbl_member WHERE username=%s OR email=%s"
        self.cursor.execute(query, (username, email))
        return self.cursor.fetchone()

    def insert_user(self, username, password, email):
        hashed_password = bcrypt.hashpw(password.encode('utf-8'), bcrypt.gensalt())
        query = "INSERT INTO tbl_member (username, password, email) VALUES (%s, %s, %s)"
        self.cursor.execute(query, (username, hashed_password, email))
        self.conn.commit()

    def validate_login(self, username, password):
        query = "SELECT * FROM tbl_member WHERE username=%s"
        self.cursor.execute(query, (username,))
        user = self.cursor.fetchone()
        if user and bcrypt.checkpw(password.encode('utf-8'), user[2].encode('utf-8')):
            return True
        return False
