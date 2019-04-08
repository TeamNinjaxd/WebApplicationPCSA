import boto3
from random import SystemRandom
from random import sample

def listarUsuariosCognitoCliente (event, context):
    
    
        cognito = boto3.client('cognito-idp', 'us-east-2')
    
        datos_nu = event['data']
        
        #IdUserPool
        clienteId = "3idk78u0u1q5ieqc0ktmkq1jc2"
    
        #Registrar nuevo cliente
        response = cognito.list_users(
            UserPoolId="us-east-2_Zi0lF6sii",
            AttributesToGet=[
                'name',
                'email',
                'phone_number'
                ]
        )
        
        lista_datos = []
        
        for a in response['Users']:
            tmp = {
                "Username":a['Username'],
                "Enabled":a['Enabled'],
                "UserStatus":a['UserStatus']
            }
            for x in a['Attributes']:
                tmp[x['Name']]=x['Value']
            lista_datos.append(tmp)
    
        return {
            "data": {
                "clientes": lista_datos,
                "cantidad": len(lista_datos)
            }
        }
