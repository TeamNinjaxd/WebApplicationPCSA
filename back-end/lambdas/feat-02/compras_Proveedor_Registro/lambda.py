import boto3

def lambda_handler(event, context):
    # TODO implement
    try:
        dynamodb = boto3.client("dynamodb", 'us-east-2')
    
        datos_item = getAtributosCompraProveedor(event['data'])
        response = dynamodb.put_item(
            TableName= 'Coleccion_Compras_Proveedor',
            Item= datos_item
        )
        data_response = response['ResponseMetadata']
        
        
    
        if (data_response['HTTPStatusCode'] == 200):
            print "LOGGER - registrar compra productos al proveedor: " "Compra al proveedor registrada correctamente"
            return {
                "response":"ok",
                "data": "Compra al proveedor registrada correctamente"
            }
        else:
            print "LOGGER - registrar compra productos al proveedor: ", json.dumps(data_response)
            return {
                "response":"error",
                "error": "Ha ocurrido un error al registrar la compra del proveedor"
            }
    except ValueError:
        return ValueError
        
def getAtributosCompraProveedor(data):
    
    lista_productos = data['lista_productos']
    
    productos_format = []
    
    #Obtener y darle forma a lista de productos
    for producto in lista_productos:
        productos_format.append(
            {
             "M": {
                "codigo": {"S":producto['codigo']},
                "precio_compra": {"N": str(producto['precio_compra'])},
                "cantidad": {"N": str(producto['cantidad'])}
                }
            }
            )
    
    return  {
                "num_factura": {"S":data['num_factura']},
                "proveedor": {"S":data['proveedor']},
                "fecha": {"S":data['fecha']},
                "lista_productos": {
                    "L": productos_format
                }
            }
