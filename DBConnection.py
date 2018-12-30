from flask import Flask
from flask.ext.mysql import MySQL
import user_model

app = Flask(__name__)

mysql = MySQL()

# MySQL configurations
app.config['MYSQL_DATABASE_USER'] = 'root'
app.config['MYSQL_DATABASE_PASSWORD'] = ''
app.config['MYSQL_DATABASE_DB'] = 'info'
app.config['MYSQL_DATABASE_HOST'] = 'localhost'

mysql.init_app(app)

con = mysql.connect()

cursor = con.cursor()


def register(user):
    cursor.callproc('register_user', (user.name, user.email, user.password))

    data = cursor.fetchall()

    if len(data) is 0:
        con.commit()
        return True
    else:
        return False


def login(email, password):
    cursor.callproc('check_password', (email, password))

    data2 = cursor.fetchall()

    user = user_model.User
    if len(data2) is not 0:

        user = user_model.User
        user.id = data2[0][0]
        user.name = data2[0][1]
        user.email = data2[0][2]
        user.password = data2[0][3]

        return user

    else:
        user = user_model.User
        user.id = 0
        user.name = ""
        user.email = ""
        user.password = ""
        return user

def checkemail(email):

    cursor.callproc('check_email', (email,))

    data2 = cursor.fetchall()

    user = user_model.User
    if len(data2) is not 0:

        user = user_model.User
        user.id = data2[0][0]
        user.name = data2[0][1]
        user.email = data2[0][2]
        user.password = data2[0][3]

        return user

    else:
        user = user_model.User
        user.id = 0
        user.name = ""
        user.email = ""
        user.password = ""
        return user



def upload_file(user_id, file_name):

    cursor.callproc('add_file', (user_id, file_name))

    data = cursor.fetchall()

    if len(data) is 0:
        con.commit()
        return True
    else:
        return False


def add_activation(id,code):
    cursor.callproc('add_activation', (id,code))

    data = cursor.fetchall()

    if len(data) is 0:
        con.commit()
        return True
    else:
        return False

def checkactivation(code):

    cursor.callproc('check_activation', (code,))

    data2 = cursor.fetchall()

    user = user_model.User
    if len(data2) is not 0:

        user = user_model.User
        user.id = data2[0][0]
        user.name = data2[0][1]
        user.email = data2[0][2]
        user.password = data2[0][3]

        return user

    else:
        user = user_model.User
        user.id = 0
        user.name = ""
        user.email = ""
        user.password = ""
        return user


def updatepassword(id,password):

    cursor.callproc('update_password', (id,password))

    data = cursor.fetchall()

    if len(data) is 0:
        con.commit()
        return True
    else:
        return False



