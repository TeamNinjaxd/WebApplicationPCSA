import boto3

def lambda_handler(event, context):
    # TODO implement
    try:
        dynamodb = boto3.client("dynamodb", 'us-east-2')
        
        
        response = dynamodb.scan(
            TableName = 'Coleccion_Producto',
            ScanFilter = {
                "Codigo": {
                    'ComparisonOperator' : 'NOT_NULL'
                }
            }
            )
        
        
        data_response = response['ResponseMetadata']
        items = response['Items']
        
        lista_productos = []
        print "-"*10
        for item in items:
            tmp = {}
            for k,v in item.items():
                tmp[k]=v.values()[0]
            lista_productos.append(tmp)
        
    
        if (data_response['HTTPStatusCode'] == 200):
            print "LOGGER - listar productos: " "Productos listados correctamente"
            return {
                "response":"ok",
                "data": {
                    "productos": lista_productos,
                    "cantidad": len(lista_productos)
                }
            }
        else:
            print "LOGGER - listar productos: ", json.dumps(data_response)
            return {
                "response":"error",
                "error": "Ha ocurrido un error al listar los productos"
            }
    except ValueError:
        return ValueError
    
    
    
    
    
    
    

