import boto3

def lambda_handler(event, context):
    # TODO implement
    try:
        dynamodb = boto3.client("dynamodb", 'us-east-2')
        
        
        response = dynamodb.scan(
            TableName = 'Coleccion_Proveedor',
            ScanFilter = {
                "RUC": {
                    'ComparisonOperator' : 'NOT_NULL'
                }
            }
            )
        
        
        data_response = response['ResponseMetadata']
        items = response['Items']
        
        lista_datos = []
        for item in items:
            tmp = {}
            for k,v in item.items():
                tmp[k]=v.values()[0]
            lista_datos.append(tmp)
        
    
        if (data_response['HTTPStatusCode'] == 200):
            return {
                "response":"ok",
                "data": {
                    "proveedores": lista_datos,
                    "cantidad": len(lista_datos)
                }
            }
        else:
            print "LOGGER - listar proveedores: ", json.dumps(data_response)
            return {
                "response":"error",
                "error": "Ha ocurrido un error al listar los proveedores"
            }
    except ValueError:
        return ValueError

