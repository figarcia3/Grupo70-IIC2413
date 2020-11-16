from flask import Flask, json, request
from pymongo import MongoClient

USER    ="grupo70"
PASS    ="grupo70"
IP      ="gray.ing.puc.cl"
DATABASE="grupo70"

URI     = f"mongodb://{USER}:{PASS}@{IP}/{DATABASE}?authSource=admin"
# La uri 'estándar' es "mongodb://user:password@ip/database"

client   = MongoClient(URI)
db       = client.get_database()
mensajes = db.mensajes
usuarios = db.usuarios

app = Flask(__name__)

@app.route("/")
def home():
    '''
    Pagina de inicio
    '''
    return "<h1>Hello World! Probando<h1>"

@app.route("/text-search")
def get_text_search():

    query = []
    mensajes.create_index([("message", "text")], "default_language"=="none")

    try:
        data = request.json
    except:
        data = {}

    try:
        USER_ID = data["userId"]
    except KeyError:
        USER_ID = None

    try:
        for string in data["desired"]:
            query.append(string)
    except KeyError:
        pass

    try:
        for string in data["required"]:
            aux = f"\"{string}\""
            query.append(aux)
    except KeyError:
        pass

    try:
        for string in data["forbidden"]:
            aux_2 = f"-{string}"
            query.append(aux_2)
    except KeyError:
        pass

    if len(query)!=0:
        query_str = " ".join(query)
        if USER_ID==None:
            msg = mensajes.find( { "$text": { "$search" : query_str }}, {"score": {"$meta": "textScore"}, "_id": False})
        else:
            msg = mensajes.find( { "$text": { "$search" : query_str }, "sender" : USER_ID }, {"score": {"$meta": "textScore"}, "_id": False})
        msg.sort([("score", {"$meta": "textScore"})])
        msg = list(msg)
    else:
        if USER_ID==None:
            msg = mensajes.find({}, {"_id": False})
        else:
            msg = mensajes.find( {"sender" : USER_ID }, {"_id": False})
        msg = list(msg)

    return json.jsonify(msg)

if __name__=="__main__":
    app.run(debug=True)