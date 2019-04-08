import boto3

def lambda_handler(event, context):
    # TODO implement
    try:
        dynamodb = boto3.client("dynamodb", 'us-east-2')
        
        datos_itemControl = getAtributosProductoControl(event['data'])
        datos = getAtributosProductoControlKey(event['data'])
        responseControl = dynamodb.update_item(
            TableName= 'Coleccion_ProductoControl',
            Key = datos,
            AttributeUpdates= datos_itemControl
        )
        data_responseControl = responseControl['ResponseMetadata']
        
        
    
        if (data_responseControl['HTTPStatusCode'] == 200):
            print "LOGGER - actuallizar producto: " "Producto actualizado correctamente"
            return {
                "response":"ok",
                "data": "Producto actualizado correctamente"
            }
        else:
            print "LOGGER - actualizar producto: ", json.dumps(data_responseControl)
            return {
                "response":"error",
                "error": "Ha ocurrido un error al actualizar el producto"
            }
    except ValueError:
        return ValueError
        
    
def getAtributosProductoControlKey(data):
    return  {
                "Codigo": {"S": str(data['codigo'])},
                "precio_compra": {"N": str(data['precio_compra'])}
            }
    
def getAtributosProductoControl(data):
    
    return  {
                "precio_venta": {
                    "Value": {
                        "N":str(data['precio_venta'])
                    },
                    "Action": "ADD"
                },
            }
    
    
    
    
    
    
    
    

