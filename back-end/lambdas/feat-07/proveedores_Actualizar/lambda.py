import boto3
import json

def lambda_handler(event, context):
    # TODO implement
    try:
        dynamodb = boto3.client("dynamodb", 'us-east-2')
        
        datos_itemControl = getAtributosProveedor(event['data'])
        datos = getAtributosProveedorKey(event['data'])
        print datos_itemControl
        print datos
        responseControl = dynamodb.update_item(
            TableName= 'Coleccion_Proveedor',
            Key = datos,
            AttributeUpdates= datos_itemControl
        )
        data_responseControl = responseControl['ResponseMetadata']
        
        
    
        if (data_responseControl['HTTPStatusCode'] == 200):
            print "LOGGER - actuallizar producto: " "Proveedor actualizado correctamente"
            return {
                "response":"ok",
                "data": "Proveedor actualizado correctamente"
            }
        else:
            print "LOGGER - actualizar proveedor: ", json.dumps(data_responseControl)
            return {
                "response":"error",
                "error": "Ha ocurrido un error al actualizar el proveedor"
            }
    except ValueError:
        return ValueError
        
    
def getAtributosProveedorKey(data):
    
    return  {
        "RUC": {
            "S": str(data["RUC"])
        }
    }
    
def getAtributosProveedor(data):
    rpt = {}
    
    for k in data:
        if ( k != 'RUC'):
            rpt[k] = {
                "Value": {"S":str(data[k])},
                "Action": "PUT"
            }
    
    return  rpt
