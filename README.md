# SuiteCRM API Client

Una biblioteca PHP para interactuar de manera sencilla con la API de SuiteCRM.

## Instalación

Utiliza Composer para instalar la biblioteca:

```bash
composer require cmercado93/suitecrm-api-client
```

## Uso Básico

A continuación se muestra un ejemplo de cómo usar la biblioteca para crear un nuevo contacto y luego recuperar sus detalles.

```php
<?php

use Cmercado93\SuitecrmApiClient\Api;
use Cmercado93\SuitecrmApiClient\Config;

require_once __DIR__ . '/vendor/autoload.php';

$domain = "http://suitecrm/service/v4_1/rest.php";
$username = 'user';
$password = 'pass';

try {

   // Configuración de la API
   $config = Config::make($domain, $username, $password);
   $api = new Api($config);

   // Crear un nuevo contacto
   $newContact = array(
      'first_name' => 'Joe',
      'last_name' => 'Davis',
      'email1' => 'jdavis@mail.com',
   );

   $newContacts = array($newContact);
   $result = $api->setEntries('Contacts', $newContacts);

   print_r($result);
   /*
   Result
   Array
   (
       [ids] => Array
           (
               [0] => a630a130-f7c8-7c15-e5ea-66a69df451c8
           )
   )
   */

   // Recuperar los detalles del contacto
   $result = $api->getEntry('Contacts', $result['ids'][0]);
   print_r($result);
   /*
   Result
   Array
   (
       [entry_list] => Array
           (
               [0] => Array
                   (
                       [id] => a630a130-f7c8-7c15-e5ea-66a69df451c8
                       [module_name] => Contacts
                       [name_value_list] => Array
                           (
                               [id] => Array
                                   (
                                       [name] => id
                                       [value] => a630a130-f7c8-7c15-e5ea-66a69df451c8
                                   )
                               [name] => Array
                                   (
                                       [name] => name
                                       [value] => Joe Davis
                                   )
                               [date_entered] => Array
                                   (
                                       [name] => date_entered
                                       [value] => 2024-07-28 19:40:31
                                   )
                               [date_modified] => Array
                                   (
                                       [name] => date_modified
                                       [value] => 2024-07-28 19:40:31
                                   )
                               [first_name] => Array
                                   (
                                       [name] => first_name
                                       [value] => Joe
                                   )
                               [last_name] => Array
                                   (
                                       [name] => last_name
                                       [value] => Davis
                                   )
                               [full_name] => Array
                                   (
                                       [name] => full_name
                                       [value] => Joe Davis
                                   )
                               [email1] => Array
                                   (
                                       [name] => email1
                                       [value] => jdavis@mail.com
                                   )

                                //
                                // Truncated data
                                //
                           )
                   )
           )
       [relationship_list] => Array()
   )
   */

} catch (\Exception $e) {
   var_dump($e->getMessage());
}
```

## Métodos Disponibles

- `getAvailableModules($filter = 'default')`
- `getDocumentRevision($documentId)`
- `getEntries($moduleName, $data = array())`
- `getEntriesCount($moduleName, $query = '', $deleted = false)`
- `getEntry($moduleName, $id, $data = array())`
- `getEntryList($moduleName, $data = array())`
- `getLanguageDefinition(array $modules)`
- `getLastViewed(array $modules)`
- `getModifiedRelationships($moduleName, $relatedModule, DateTimeInterface $fromDate, DateTimeInterface $toDate, array $data = array()`
- `getModuleFields($moduleName, array $data = array())`
- `getModuleFieldsMd5(array $moduleNames)`
- `getModuleLayout(array $modules, array $data = array())`
- `getModuleLayoutMd5(array $modules, array $data = array())`
- `getRelationships($moduleName, $moduleId, $linkFieldName, $data = array())`
- `getServerInfo()`
- `getUpcomingActivities()`
- `getUserId()`
- `seamlessLogin()`
- `searchByModule($searchString, array $modules = array(), $data = array())`
- `setDocumentRevision(array $note = array())`
- `setEntries($moduleName, array $valueList)`
- `setEntry($moduleName, $moduleId, array $valueList = array())`
- `getNoteAttachment($id)`
- `setNoteAttachment($noteId, $filename, $fileContent)`
- `setRelationship($moduleName, $moduleId, $linkFieldName, array $relatedIds = array(), array $nameValueList = array(), $delete = false)`
- `setRelationships(array $moduleNames = array(), array $moduleIds = array(), array $linkFieldNames = array(), array $relatedIds = array(), array $nameValueLists = array(), array $deleteArray = array())`

## Contribuciones

Las contribuciones son bienvenidas. Por favor, envía un pull request o abre un issue para discutir cualquier mejora.

## Licencia

Distribuido bajo la licencia MIT. Vea LICENSE.md para más información.
