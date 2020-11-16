from flask import Flask

app = Flask(__name__)

@app.route("/")

def home():
    '''
    Pagina de inicio
    '''
    return "<h1>Hello World! Probando<h1>"

if __name__=="__main__":
    app.run()
    app.run(debug=True)