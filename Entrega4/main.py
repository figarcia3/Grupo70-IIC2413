from flask import Flask, json, request
from pymongo import MongoClient

USER    ="grupo70"
PASS    ="grupo70"
IP      ="gray.ing.puc.cl"
DATABASE="grupo70"

URI     = f"mongodb://{USER}:{PASS}@{IP}/{DATABASE}?authSource=admin"
# La uri 'estándar' es "mongodb://user:password@ip/database"

MESSAGE_KEYS = ['message', 'sender', 'receptant',
            'lat', 'long', 'date']

client   = MongoClient(URI)
db       = client.get_database()
mensajes = db.mensajes
usuarios = db.usuarios

app = Flask(__name__)

@app.route("/")
def home():
    '''
    Página de inicio
    '''
    return "<h1>¡Hola!</h1>"

#### METODOS GET BASICO #####
@app.route("/messages")
def get_messages():
    '''
    Entrega todos los mensajes
    '''
    id1 = request.args.get("id1", False)
    id2 = request.args.get("id2", False)

    if id1 != False and id2 != False:
        user1 = list(db.usuarios.find({"uid":int(id1)}, {"_id": 0}))
        user2 = list(db.usuarios.find({"uid":int(id2)}, {"_id": 0}))
    
        if user1 == [] or user2 == []:
            return json.jsonify({"error": "ID user no existe"}) 
        else:
            search = {
                "$or":
                [
                    {"sender":int(id1), "receptant":int(id2)},
                    {"sender":int(id2), "receptant":int(id1)}
                ]
            }
            messages = list(db.mensajes.find(search,{"_id":0}).sort("date"))
            return json.jsonify({"error": "No hay mensajes"})  if messages == [] else json.jsonify(messages) 

    else:
        messages = list(db.mensajes.find({}, {"_id": 0}))
        return json.jsonify(messages)

@app.route("/messages/<int:mid>")
def get_messages_id(mid):
    '''
    Entrega la informacion del mensaje con ese mid
    '''
    messages = list(db.mensajes.find({"mid":mid}, {"_id": 0}))
    if messages == []:
        return json.jsonify({"error": "ID mensaje no existe"}) 
    else :
        return json.jsonify(messages)


@app.route("/users")
def get_users():
    '''
    Obtiene todos los usuarios
    '''
    users = list(db.usuarios.find({}, {"_id": 0}))

    return json.jsonify(users)


@app.route("/users/<int:uid>")
def get_users_id(uid):
    '''
    Obtiene todos los usuarios
    '''
    user = list(db.usuarios.find({"uid":uid}, {"_id": 0}))
    message_user = list(db.mensajes.find({"sender":uid}, {"_id": 0}))

    if user == []:
        return json.jsonify({"error": "ID user no existe"}) 
    else:
        y = json.loads('{}')
        y['user'] = user
        y['sent_message'] = message_user
        return json.jsonify(y)



@app.route("/messages", methods=["POST"])
def send_message():
    '''
    Agrega un mensaje (si es válido)
    '''
    
    status = 0
    falta = []
    data = dict()
    for key in MESSAGE_KEYS:
        if key not in request.json:
            status = 1
            falta.append(key)
        else:
            data[key] = request.json[key]
    if set(request.json.keys()) != set(MESSAGE_KEYS):
        status = 2 if status == 1 else 3
    if status != 0:
        error = {"succes": False}
        if status == 1:
            error["key(s) faltantes(s)"] = falta
        elif status == 2:
            error["key(s) faltantes(s)"] = falta
            error["details"] = "Hay keys extra"
        else:
            error["details"] = "Hay keys extra"
        return json.jsonify(error)
    else:
        if not str(data["lat"]).lstrip('-').replace('.','',1).isdigit():
            return json.jsonify({"succes": False, "details": "formato incorrecto de 'lat'"})
        elif not str(data["long"]).lstrip('-').replace('.','',1).isdigit():
            return json.jsonify({"succes": False, "details": "formato incorrecto de 'long'"})
        elif list(db.usuarios.find({"uid":data["sender"]}, {"_id": 0})) == [] or list(db.usuarios.find({"uid":data["receptant"]}, {"_id": 0})) == []:
            return json.jsonify({"succes": False, "details": "uid no valida"})
        else:
            id = list(db.mensajes.find({}).sort("mid",-1).limit(1))[0]["mid"] + 1
            data["mid"] = id
            result = db.mensajes.insert_one(data)
            return json.jsonify({"succes": True, "message_id": id})


@app.route("/text-search")
def get_text_search():
    """
    
    Busca un mensaje

    """
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
        if len(query)!=0:
            for string in data["forbidden"]:
                aux_2 = f"-{string}"
                query.append(aux_2)
        else:
            for string in data["forbidden"]:
                aux_2 = f"{string}"
                query.append(aux_2)

            query_str = " ".join(query)
            set_mid = set()
            list_to_return = []

            total_msg = mensajes.find( {}, { "_id": False})
            not_msg   = mensajes.find({"$text": { "$search" : query_str }},{"_id": False})

            for msg in not_msg:
                set_mid.add(msg["mid"])
            
            for msg in total_msg:
                if msg["mid"] not in set_mid:
                    list_to_return.append(msg)

            return json.jsonify(list_to_return)

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


@app.route("/message/<int:mid>", methods=['DELETE'])
def delete_msg(mid):
    '''
    Elimina el mensaje
    '''
    if len(list(mensajes.find({"mid": mid}))) == 0:
        return json.jsonify({"success": False})

    else:
        mensajes.remove({"mid": mid})
        return json.jsonify({"success": True})

if __name__=="__main__":
    app.run(debug=True)