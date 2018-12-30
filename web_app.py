import os
import string
import random
import DBConnection, user_model

from flask import Flask, render_template, session, request, flash, jsonify
from flask_mail import Mail, Message

from flask.ext.googlemaps import GoogleMaps, Map

app = Flask(__name__)
app.config.update(dict(
    DEBUG = True,
    MAIL_SERVER = 'smtp.gmail.com',
    MAIL_PORT = 587,
    MAIL_USE_TLS = True,
    MAIL_USE_SSL = False,
    MAIL_USERNAME = 'anyonecanaccess123@gmail.com',
    MAIL_PASSWORD = 'ANYone123',
))
mail = Mail(app)

GoogleMaps(app, key="8JZ7i18MjFuM35dJHq70n3Hx4")


@app.route('/')
def home():
    if not session.get('logged_in'):
        return render_template('login.html')
    else:
        return render_template('home.html')


@app.route('/login', methods=['POST'])
def login():
    email = str(request.form['email'])
    password = str(request.form['password'])

    if email != "" and password != "":

        user = DBConnection.login(email, password)

        if (user.id):

            session['logged_in'] = True
            session['user_id'] = user.id
            session['user_name'] = user.name
            session['user_email'] = user.email
            session['user_password'] = user.password

            return home()
        else:
            session["error_login"] = "Email or Password is Invalid"

            return render_template("login.html")


@app.route('/logout')
def logout():
    session['logged_in'] = False
    session['user_id'] = ""
    session['user_name'] = ""
    session['user_email'] = ""
    session['user_password'] = ""

    return render_template("login.html")


@app.route('/show_register')
def show_register():
    if not session.get('logged_in'):
        return render_template('register.html')
    else:
        return render_template('home.html')


@app.route('/register', methods=['POST'])
def register():
    user = user_model.User
    user.name = str(request.form['name'])
    user.email = str(request.form['email'])
    user.password = str(request.form['password'])

    if DBConnection.register(user):

        return home()

    else:

        return render_template("register.html")


@app.route('/show_profile')
def show_profile():
    if not session.get('logged_in'):

        return render_template('login.html')
    else:
        return render_template('profile.html')


APP_ROOT = os.path.dirname(os.path.abspath(__file__))


# upload larg file
@app.route("/upload", methods=["POST"])
def upload():
    target = os.path.join(APP_ROOT, 'files/')

    if not os.path.isdir(target):
        os.mkdir(target)

    print(request.files.getlist("file"))

    for upload in request.files.getlist("file"):
        filename = upload.filename
        destination = "/".join([target, filename])
        upload.save(destination)

    DBConnection.upload_file(int(session["user_id"]), filename)
    return render_template("profile.html")


@app.route('/show_checkemail')
def show_checkemail():
    return render_template('check_email.html')


@app.route('/show_checkactivation')
def show_checkactivation():
    if not session.get('email_checked'):
        return render_template('check_email.html')
    else:
        return render_template('check_activation.html')


@app.route('/show_updatepassword')
def show_updatepassword():
    if not session.get('activation_checked'):
        return render_template('check_email.html')
    else:
        return render_template('update_password.html')


@app.route('/checkemail', methods=["POST"])
def checkemail():
    email = str(request.form['email'])

    user = DBConnection.checkemail(email)

    if (int(user.id) >0):

        session['email_checked'] = True
        session['user_checked_id'] = user.id
        session['user_checked_name'] = user.name
        session['user_checked_email'] = user.email

        def id_generator(size=6, chars=string.ascii_uppercase + string.digits):
            return ''.join(random.choice(chars) for _ in range(size))

        activation_code = id_generator(8)
        DBConnection.add_activation(int(session['user_checked_id']),activation_code)

        def send_mail():

            receive =[]
            receive.append(str(session['user_checked_email']))

            msg = Message("Activation code",sender='anyonecanaccess123@gmail.com',recipients= receive)
            msg.body = "hello this is your activation code"+activation_code
            mail.send(msg)

        send_mail()



        return show_checkactivation()
    else:
        session["error_checkemail"] = "your Email not registed yet"

        return show_checkemail()


@app.route('/checkactivation',methods=["POST"])
def checkactivation():
    activate = str(request.form['activation_code'])

    user = DBConnection.checkactivation(activate)

    if (user.id):

        session['activation_checked'] = True
        session['user_checked_id'] = user.id
        session['user_checked_name'] = user.name
        session['user_checked_email'] = user.email

        return show_updatepassword()
    else:
        session["error_activation_code"] = "this code is Invalid"

        return show_checkactivation()


@app.route('/updatepassword',methods=["POST"])
def updatepassword():
    password = str(request.form['password'])

    DBConnection.updatepassword(int(session['user_checked_id']), password)

    return home()

@app.route('/show_place')
def show_place():

    mymap = Map(
        identifier="view-side",
        lat=37.4419,
        lng=-122.1419,
        markers=[(37.4419, -122.1419)]
    )
    return render_template('place.html', mymap=mymap)




if __name__ == '__main__':
    app.secret_key = os.urandom(12)
    app.debug = True
    app.run()
