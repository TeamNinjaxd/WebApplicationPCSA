import boto3
from random import SystemRandom
from random import sample

def crearUsuarioCognitoClientePersona (event, context):
    
    try:
        cognito = boto3.client('cognito-idp', 'us-east-2')
    
        datos_nu = event['data']
        
        #IdUserPool
        clienteId = getIdClient(len(datos_nu['username']))
        
        #Datos del cliente
        atributos = genAtributosList(datos_nu, len(datos_nu['username']))
        
        #Generar o asignar password
        if ( 'password' in datos_nu):
            password = datos_nu['password']
        else:
            password = genPassword()
    
    
        #Registrar nuevo cliente
        response = cognito.sign_up(
            ClientId=clienteId,
            Username=datos_nu['username'],
            Password=password,
            UserAttributes=atributos,
        )
    
        return {
            "response": {
                "estado":"ok"
            },
            "data": {
                "password":password
            }
        }
        
    except:
        return {
            "response": {
                "estado":"error"
            },
            "event": event,
            "error": {
                "errorType":"",
                "errorMessage":""
            }
        }

def genPassword():
    digito = "0123456789"
    letra = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"
    rd = SystemRandom()
    return ''.join([rd.choice(letra) for i in range(5)]).capitalize() + ''.join([rd.choice(digito) for i in range(3)])
    
def getIdClient(dato):
    if (dato == 8): return "3idk78u0u1q5ieqc0ktmkq1jc2"
    elif (dato == 11): return "7vsin9spo2uf5vh274lekiggkv"
    else: return ""

def genAtributosList(datos, tipo):
    if (tipo == 8):
        return [
            {
                'Name':'address',
                'Value': datos['direccion']
            },
            {
                'Name':'email',
                'Value': datos['correo']
            },
            {
                'Name':'family_name',
                'Value': datos['apellidos']
            },
            {
                'Name':'name',
                'Value': datos['nombre']
            },
            {
                "Name": "phone_number",
                "Value": "+51"+datos['celular']
            }
        ]
    elif (tipo == 11):
        return [
            {
                'Name':'address',
                'Value': datos['direccion']
            },
            {
                'Name':'email',
                'Value': datos['correo']
            },
            {
                'Name':'name',
                'Value': datos['nombre']
            },
            {
                "Name": "phone_number",
                "Value": "+51"+datos['celular']
            }
        ]
    else:
        return []
