import boto3

def lambda_handler(event, context):
    # TODO implement
    try:
        dynamodb = boto3.client("dynamodb", 'us-east-2')
    
        datos_item = getAtributosProducto(event['data'])
        response = dynamodb.put_item(
            TableName= 'Coleccion_Producto',
            Item= datos_item
        )
        data_response = response['ResponseMetadata']
        
        datos_itemControl = getAtributosProductoControl(event['data'])
        responseControl = dynamodb.put_item(
            TableName= 'Coleccion_ProductoControl',
            Item= datos_itemControl
        )
        data_responseControl = responseControl['ResponseMetadata']
        
        
    
        if (data_response['HTTPStatusCode'] == 200 and data_responseControl['HTTPStatusCode'] == 200):
            print "LOGGER - crear producto: " "Producto creado correctamente"
            return {
                "response":"ok",
                "data": "Producto creado correctamente"
            }
        else:
            print "LOGGER - crear producto: ", json.dumps(data_response)
            return {
                "response":"error",
                "error": "Ha ocurrido un error al registrar el producto"
            }
    except ValueError:
        return ValueError
        
def getAtributosProducto(data):
    
    return  {
                "Codigo": {"S":data['codigo']},
                "Descripcion": {"S":data['descripcion']},
                "Foto": {"S":data['foto']},
                "Marca": {"S":data['marca']},
                "Nombre": {"S":data['nombre']},
                "Proveedor": {"S":data['proveedor']},
                "Categoria": {"S":data['categoria']}
            }
    
def getAtributosProductoControl(data):
    
    return  {
                "Codigo": {"S":data['codigo']},
                "precio_compra": {"N":str(data['precio_compra'])},
                "cantidad": {"N":str(data['cantidad'])},
            }
    
    
    
    
    
    
    
    

