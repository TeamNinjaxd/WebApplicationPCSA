import boto3

def lambda_handler(event, context):
    # TODO implement
    try:
        dynamodb = boto3.client("dynamodb", 'us-east-2')
    
        datos_item = getAtributos(event['data'])
    
        response = dynamodb.put_item(
            TableName= 'Coleccion_Proveedor',
            Item= datos_item
        )
        
        data_response = response['ResponseMetadata']
    
        if (data_response['HTTPStatusCode'] == 200):
            print "LOGGER - createCliente: " "Usuario creado correctamente"
            return {
                "response":"ok",
                "data": "Usuario creado correctamente"
            }
        else:
            print "LOGGER - createCliente: ", json.dumps(data_response)
            return {
                "response":"error",
                "error": "Ha ocurrido un error al registrar el proveedor"
            }
    except ValueError:
        return ValueError
        
def getAtributos(data):
    
    return  {
                "RUC": {"S":data['RUC']},
                "correo": {"S":data['correo']},
                "direccion": {"S":data['direccion']},
                "nombre": {"S":data['nombre']},
                "celular": {"S":data['celular']}
            }
    
    
    
    
    
    
    
    
    
    
    

