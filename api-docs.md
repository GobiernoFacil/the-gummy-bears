# Apis disponibles en contrataciones abiertas CDMX
## Contratos
### Obtén todos los contratos
Este método regresa la clave única para todos los contratos disponibles. La clave se puede usar para obtener el contrato completo. Más información abajo.

* api/contratos/todos [GET]
```json
[{"id":1,"ocdsid":"OCDS-87SD3T-SEFIN-AD-SF-DRM-001-2015","ejercicio":2015,"cvedependencia":901,"nomdependencia":"SECRETAR\u00cdA DE FINANZAS","published_date":"2015-11-04","uri":"http:\/\/www.contratosabiertos.cdmx.gob.mx\/OCDS-87SD3T-SEFIN-AD-SF-DRM-001-2015.json","publisher_id":1,"created_at":"2016-05-03 21:46:31","updated_at":"2016-05-03 21:46:33”}, …]
```

### Obtén todos los contratos por año
Similar al endpoint anterior, este sirve para obtener todos los contratos en un año determinado. El array contiene la clave única del contrato y el nombre de quien publica la información.

* api/contratos/ejercicio/{year} [GET]
```json
[{"id":1,"ocdsid":"OCDS-87SD3T-SEFIN-AD-SF-DRM-001-2015","ejercicio":2015,"cvedependencia":901,"nomdependencia":"SECRETAR\u00cdA DE FINANZAS","published_date":"2015-11-04","uri":"http:\/\/www.contratosabiertos.cdmx.gob.mx\/OCDS-87SD3T-SEFIN-AD-SF-DRM-001-2015.json","publisher_id":1,"created_at":"2016-05-03 21:46:31","updated_at":"2016-05-03 21:46:33”}, …]
```

### Obtén la información completa por contrato
Con este endpoint, se obtiene la información completa del contrato, como lo indica el Open Contracting Partnership (http://standard.open-contracting.org/latest/en/schema/reference/).

* api/contrato/{ocds} [GET]

### Busca un contrato por palabra clave
Es posible buscar por palabra clave dentro del contrato. El campo de búsqueda se llama “query”, y es opcional seleccionar la página de resultados de la búsqueda. La respuesta incluye el número de resultados, página que se está regresando y los resultados por página.

* api/contratos/buscar/{page?}?query [GET]
```json
{"contracts":[{"id":15,"ocdsid":"OCDS-87SD3T-SEFIN-DRM-AD-CC-010-2015","ejercicio":2015,"cvedependencia":901,"nomdependencia":"SECRETAR\u00cdA DE FINANZAS","published_date":"2015-10-12","uri":"http:\/\/www.contratosabiertos.cdmx.gob.mx\/OCDS-87SD3T-SEFIN-DRM-AD-CC-010-2015.json","publisher_id":1,"created_at":"2016-05-03 21:46:31","updated_at":"2016-05-03 21:46:47”}, …],”page":1,"total":1}
```

### Obtén los valores oportunos del contrato
Si solo se quiere la información (agregada) más reciente del contrato, se puede usar esta api, que regresa la información del dinero presupuestado, autorizado y gastado por contrato, para el último release (versión del contrato). El formato en el que se obtiene la información del contrato, difiere del estándar, en cuanto a que solo es un resumen del mismo, y no el contrato completo.

* api/contrato/actual/{ocds}
```json
{"id":8,"contract_id":8,"release_id":8,"ocdsid":"OCDS-87SD3T-SEFIN-DRM-AD-011-2015","planning":1270340.49,"tender":1270340.49,"awards":1777723.76,"contracts":0,"date":"2015-10-07","created_at":"2016-05-03 21:47:06","updated_at":"2016-05-03 21:47:06","local_id":1,"release":{"id":8,"local_id":1,"contract_id":8,"ocid":"OCDS-87SD3T-SEFIN-DRM-AD-011-2015","date":"2015-10-07","initiation_type":"tender","planning_id":null,"buyer_id":1,"tender_id":null,"language":"es","created_at":"2016-05-03 21:46:40","updated_at":"2016-05-03 21:52:15","is_latest":1,"tender":{"id":8,"created_at":"2016-05-03 21:46:40","updated_at":"2016-05-03 21:46:40","release_id":8,"local_id":"OCDS-87SD3T-SEFIN-DRM-AD-011-2015","title":"MIGRACI\u00d3N DE LOS SERVIDORES","description":"MIGRACI\u00d3N DE LOS SERVIDORES","status":"complete","amount":1270340.49,"currency":"MXN","procurement_method":"limited","award_criteria":"bestValueToGovernment","tender_start":"2015-10-20","tender_end":"2015-10-20","enquiry_start":"1970-01-01","enquiry_end":"1970-01-01","award_start":"2015-10-20","award_end":"2015-10-20","has_enquiries":1,"eligibility_criteria":" Servicio,Condiciones,Precio,Otro&ANEXO TECNICO","number_of_tenderers":3,"submission_method":"written"},"planning":{"id":8,"release_id":8,"amount":1270340.49,"currency":"MXN","project":"AUTORIZACI\u00d3N PRESUPUESTAL SPP\/449\/2015","created_at":"2016-05-03 21:46:40","updated_at":"2016-05-03 21:46:40"},"singlecontracts":[],"awards":[{"id":6,"created_at":"2016-05-03 21:46:40","updated_at":"2016-05-03 21:46:40","local_id":1,"title":"MIGRACI\u00d3N DE LOS SERVIDORES","description":"MIGRACI\u00d3N DE LOS SERVIDORES","status":"active","date":"2016-01-07","value":1777723.76,"currency":"MXN","release_id":8}]}}
```

## Proveedores
### Obtén todos los proveedores
obtén la información de contacto de todos los proveedores que han participado en una licitación o han obtenido un contrato con la CDMX. Esta lista solo cuenta con los proveedores que aparecen en los contratos publicados en el sitio.

* api/proveedores/todos [GET]
```json
[{"id":1,"rfc":”CUMB306206M8","name":"SERVICIOS INTEGRALES CONTRA INCENDI","total":null,"street”:”CHIPITLÁN”,”locality":"SAN MATEO; TEXAS”,”region”:”PUE”,”zip”:”74000”,”country":"MX","contact_name”:”ARTURO C.”,”email":"No Capturado","phone”:”555-55-55”,”fax”:”555-55-55”,”url":"No Capturado","created_at":"2016-05-03 21:46:33","updated_at":"2016-05-03 21:52:16","tender_num":3,"award_num":3,"budget":2278067.39}, ..]
```

### Obtén la información de un solo proveedor
Obtén la información de contacto de un proveedor mediante el RFC. El objeto por proveedor es idéntico al que regresa el array de  todos los proveedores (el endpoint anterior).

* api/proveedor/{rfc} [GET]


## Dependencias
### Obtén la lista de dependencias
Esta es la lista de dependencias (o compradores). 

* api/dependencias/todas [GET]
```json
[{"id":1,"local_id":"0901","uri":"http:\/\/www.contratosabiertos.cdmx.gob.mx","name":"SECRETAR\u00cdA DE FINANZAS","address_id":null,"contact_point_id":null,"created_at":"2016-05-03 21:46:33","updated_at":"2016-05-03 21:46:33"}]
```

### obtén la relación entre dependecias y proveedores
Este endpoint contiene un resumen de la relación de las dependencias con cada proveedor.

* api/dependencia-proveedor/{page?} [GET]
```json
[{"id":21,"provider_id":21,"buyer_id":1,"tender_num":1,"award_num":1,"budget":9742882,"contract_budget":9742882,"created_at":"2016-05-15 23:44:17","updated_at":"2016-05-15 23:44:17","buyer":{"id":1,"local_id":"0901","uri":"http:\/\/www.contratosabiertos.cdmx.gob.mx","name":"SECRETAR\u00cdA DE FINANZAS","address_id":null,"contact_point_id":null,"created_at":"2016-05-03 21:46:33","updated_at":"2016-05-03 21:46:33"},"provider":{"id":21,"rfc":"SMI680112PG9","name":"SERVICIOS MEXICANOS DE INGENIERIA","total":null,"street":"AVENIDA COYOACAN","locality":"BENITO JUAREZ","region":"DF","zip":"03100","country":"MX","contact_name":"ING. CARLOS DAVID SANCHEZ PE\u00d1ALOZA","email":"atecion.clientes@semicmex.com.mx","phone":"55756287","fax":"55756287","url":"WWW.SEMICMEX.COM.MX","created_at":"2016-05-03 21:46:48","updated_at":"2016-05-12 04:46:30","tender_num":1,"award_num":1,"budget":9742882.48,"contract_budget":9742882.48}}, ...]
```

## Licitaciones
### obtén la lista de licitaciones
Esta es la lista de licitaciones (_tenders_) para la última versión de cada proceso de contratación.

* api/licitaciones/{page?} [GET]
