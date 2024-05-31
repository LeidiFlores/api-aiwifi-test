<h1>Prueba para AIWIFI</h1>

<h2>API para registrar contactos de clientes</h2>

<p>Se tiene tambien estadisticas con informacion sobre la edad,la nacionalidad y el genero. 
Construido con Laravel 11.
</p>


<h2>Instalacion</h2>
Seguir los pasos de https://laravel.com/docs/11.x/installation

Se adjunta el csv para pruebas, se utilizo POSTMAN como entorno.
<h2>Documentacion rutas</h2>

        POST /api/register
Para el registro de los usuarios

Request cURL
 ```       
        curl --location 'http://127.0.0.1:8000/api/register' \
        --form 'name="Leidi"' \
        --form 'email="leidi@leididdemail.com"' \
        --form 'password="karimkarim"' \
        --form 'c_password="karimkarim"'
```
Response JSON
```
{
    "success": true,
    "data": {
        "token": "*****",
        "name": "Leidi"
    },
    "message": "User register successfully."
}
```

        POST /api/login
Obtener la llave para el auth

Request cURL
```
        curl --location 'http://127.0.0.1:8000/api/login' \
        --form 'email="leidi@leidi.email.com"' \
        --form 'password="karimkarim"'
```
Response JSON
```
{
    "success": true,
    "data": {
        "token": "******",
        "name": "Leidi"
    },
    "message": "User login successfully."
}
```

<h4>CRUD Contacts - Requiere Authentication</h4>

        GET /api/contacts
Obtener lista de contactos
Request cURL
```
        curl --location 'http://127.0.0.1:8000/api/contacts' \
--header 'Authorization: Bearer ****'
```
Response JSON
```
{
    "success": true,
    "data": [
        {
            "id": 3,
            "user_id": 3,
            "name": "leidi",
            "email": "leidi@gmail.com",
            "estimates_gender": null,
            "probability_gender": null,
            "estimates_age": null,
            "estimates_nationality": null,
            "probability_nationality": 0,
            "mail_smtp_check": false,
            "mail_role": false,
            "mail_disposable": false,
            "mail_free": true,
            "created_at": "2024-05-31",
            "updated_at": "2024-05-31"
        },
        {
            "id": 4,
            "user_id": 3,
            "name": "test",
            "email": "test@test.com",
            "estimates_gender": null,
            "probability_gender": null,
            "estimates_age": null,
            "estimates_nationality": null,
            "probability_nationality": 0,
            "mail_smtp_check": false,
            "mail_role": false,
            "mail_disposable": false,
            "mail_free": true,
            "created_at": "2024-05-31",
            "updated_at": "2024-05-31"
        }
    ],
    "message": "List of contacts."
}
```


        POST /api/contacts
Crear nuevos contactos con csv
Request cURL
```
        curl --location 'http://127.0.0.1:8000/api/contacts' \
        --header 'Authorization: Bearer ******' \
        --form 'csv=@"/Users/leidi/Downloads/test_api_aiwifi - Hoja 1.csv"'
```
Response JSON
```
{
    "success": true,
    "data": [
        {
            "id": 2,
            "user_id": 3,
            "name": "leidi",
            "email": "leidi@gmail.com",
            "estimates_gender": null,
            "probability_gender": null,
            "estimates_age": null,
            "estimates_nationality": null,
            "probability_nationality": 0,
            "mail_smtp_check": false,
            "mail_role": false,
            "mail_disposable": false,
            "mail_free": true,
            "created_at": "2024-05-31",
            "updated_at": "2024-05-31"
        }
    ],
    "message": "Contacts create successfully."
}
```

        GET /api/contacts/{id}
Obtener un contacto especifico
Request cURL
```
        curl --location 'http://127.0.0.1:8000/api/contacts/1' \
    --header 'Authorization: Bearer ******'
```
Response JSON
```
{
    "success": true,
    "data": {
        "id": 4,
        "user_id": 3,
        "name": "test",
        "email": "test@test.com",
        "estimates_gender": null,
        "probability_gender": null,
        "estimates_age": null,
        "estimates_nationality": null,
        "probability_nationality": 0,
        "mail_smtp_check": false,
        "mail_role": false,
        "mail_disposable": false,
        "mail_free": true,
        "created_at": "2024-05-31",
        "updated_at": "2024-05-31"
    },
    "message": "User found successfully."
}
```
        DELETE /api/contacts/{id}
Remover un contacto
Request cURL
```
        curl --location --request DELETE 'http://127.0.0.1:8000/api/contacts/1' \
    --header 'Authorization: Bearer ******'
```
Response JSON
```
{
    "success": true,
    "data": "Remove contact with email: leidi@gmail.com",
    "message": "Register remove successfull."
}
```     

    GET /api/contacts/stadistics
Obtener estadisticas de los contactos
Request cURL
```
{
    curl --location --request GET 'http://127.0.0.1:8000/api/contacts/stadistics' \
--header 'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiNGIxNDdmYWY1M2Y0MDUxYjMzYTc5M2E0MGQ1OTkzZmEzNDI2NTEwZDlmMzVkY2ZkYWQwNTNhZWZjNDAxYWFjNTVmZTIxMmVlOWMzZmVhNTYiLCJpYXQiOjE3MTcxODk2MDEuMDg0ODg4LCJuYmYiOjE3MTcxODk2MDEuMDg0ODg4LCJleHAiOjE3NDg3MjU2MDEuMDgyOTc0LCJzdWIiOiIzIiwic2NvcGVzIjpbXX0.oOboVhrfNqcold8vJ2APDDYTB_6vw-cJ7OpcSgMLmgpjctH7nHXzNacMZBrQGMZGPMP5IzbJlp3yjZgHucb1V9BFe3O8PlP6ifUhFU5217Nk0xeeOwFiVnNIGjnZiOqI06rkWrlwnpZpL6-D4rRcJ7qYfxiJOF_KBO85j94hz2HXNvlHgw1Oj9LqsLlRjAgciwgGzjKKake19kB5IswqFRZrg5fqy2-1N-fNgmG6ITmTMnXmFeUaQ6_py5P8jA448kWBarn9e5p2rLqULVbi3TOTQ2K2wWarP4k92uez6DPV218bhVktQReCjPn7OayCSTY1qD79y9xbpVjq1CSI4K7K9QSajg1pnneXKuAu4ndgZyQ4p4JwcSkDFXdNqrXNbaJevZeKv-DthQUEjSQchXraiDOxiNS-CiRFodBF1FXruazKEJpP1nvYGFv-v3SrAPIiko_rb_yDJPVZfrRpKQC29An4GApYwihxOvoqFT2XqoyljQYtHTOMu7vybU3n8YR1IUtLg3gEonEnSiqkrFqTpIPHFl-7vPPBlVKdWQM5xFmi0OEP3av4fey0Cf9Q3zbnJhiV75JDzc3ev5ikI_TO03zV-9JkqFPvb2NVwyqZ_XdfRNIAuJ8bbVZW8dFwY2pVTtWOsUxEe_Rdr3AZOnVyE_qf72JUyNB62bLwGHQ' \
--form 'csv=@"/Users/leidi/Downloads/test_api_aiwifi - Hoja 1.csv"'
}
```
Response JSON
```
{
    "success": true,
    "data": {
        "estimates_gender_female": 0,
        "estimates_gender_male": 0,
        "estimates_age_oldest_18": 0,
        "estimates_age_eldest_18": 2,
        "mail_smtp_check_count": 0,
        "mail_role_count": 0,
        "mail_disposable_count": 0,
        "mail_free_count": 2
    },
    "message": "Data for contacts."
}
```    

<h2>Manejo de Errores en el API</h2>
<p>Se manejan con los codigos http y ademas un campo en la respuesta llamado <i>success</i></p>

<b>Pruebas hechas con PHPUnit</b>

<h2> Consideraciones a tomar en cuenta </h2>

- En cuestiones de seguridad, no se guarda ningun token en la BD, eso debe mejorarse, si se llegara a pagar los servicios, actualmente solo se toma del env el de mail.
