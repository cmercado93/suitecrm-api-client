<?php

namespace Cmercado93\SuitecrmApiClient;

use Cmercado93\SuitecrmApiClient\Config;
use DateTimeInterface;

class Api
{
    protected $config;

    /**
     * @param Config $config
     */
    public function __construct(Config $config)
    {
        $this->config = $config;
    }

    public function __destruct()
    {
        $this->getConfig()->getAuth()->logout();
    }

    /**
     * @return Config
     */
    protected function getConfig()
    {
        return $this->config;
    }

    public function getAvailableModules($filter = 'default')
    {
        $data = array(
            'session' => $this->getConfig()->getAuth()->getTokenId(),
            'filter' => $filter,
        );

        return $this->getConfig()->getHttp()->sendData('get_available_modules', $data);
    }

    public function getDocumentRevision($documentId)
    {
        $data = array(
            'session' => $this->getConfig()->getAuth()->getTokenId(),
            'i' => $documentId,
        );

        return $this->getConfig()->getHttp()->sendData('get_document_revision', $data);
    }

    public function getEntries($moduleName, $data = array())
    {
        $data['session'] = $this->getConfig()->getAuth()->getTokenId();

        $data['module_name'] = $moduleName;

        $data['ids'] = isset($data['ids']) ? $data['ids'] : array();

        $data['select_fields'] = isset($data['select_fields']) ? $data['select_fields'] : array();

        $data['link_name_to_fields_array'] = isset($data['link_name_to_fields_array']) ? $data['link_name_to_fields_array'] : array();

        return $this->getConfig()->getHttp()->sendData('get_entries', $data);
    }

    public function getEntriesCount($moduleName, $query = '', $deleted = false)
    {
        $data['session'] = $this->getConfig()->getAuth()->getTokenId();

        $data['module_name'] = $moduleName;

        $data['query'] = $query;

        $data['deleted'] = $deleted;

        return $this->getConfig()->getHttp()->sendData('get_entries_count', $data);
    }

    public function getEntry($moduleName, $id, $data = array())
    {
        $data['session'] = $this->getConfig()->getAuth()->getTokenId();

        $data['module_name'] = $moduleName;

        $data['id'] = $id;

        $data['select_fields'] = isset($data['select_fields']) ? $data['select_fields'] : array();

        $data['link_name_to_fields_array'] = isset($data['link_name_to_fields_array']) ? $data['link_name_to_fields_array'] : array();

        return $this->getConfig()->getHttp()->sendData('get_entry', $data);
    }

    public function getEntryList($moduleName, $data = array())
    {
        $data['session'] = $this->getConfig()->getAuth()->getTokenId();

        $data['module_name'] = $moduleName;

        $data['query'] = isset($data['query']) ? $data['query'] : '';

        $data['order_by'] = isset($data['order_by']) ? $data['order_by'] : '';

        $data['offset'] = isset($data['offset']) ? $data['offset'] : 0;

        $data['select_fields'] = isset($data['select_fields']) ? $data['select_fields'] : array();

        $data['link_name_to_fields_array'] = isset($data['link_name_to_fields_array']) ? $data['link_name_to_fields_array'] : array();

        $data['max_results'] = isset($data['max_results']) ? $data['max_results'] : 0;

        $data['deleted'] = isset($data['deleted']) ? $data['deleted'] : false;

        $data['favorites'] = isset($data['favorites']) ? $data['favorites'] : false;

        return $this->getConfig()->getHttp()->sendData('get_entry_list', $data);
    }

    public function getLanguageDefinition(array $modules)
    {
        $data = array(
            'session' => $this->getConfig()->getAuth()->getTokenId(),
            'modules' => $modules,
        );

        return $this->getConfig()->getHttp()->sendData('get_language_definition', $data);
    }

    public function getLastViewed(array $modules)
    {
        $data = array(
            'session' => $this->getConfig()->getAuth()->getTokenId(),
            'module_names' => $modules,
        );

        return $this->getConfig()->getHttp()->sendData('get_last_viewed', $data);
    }

    public function getModifiedRelationships($moduleName, $relatedModule, DateTimeInterface $fromDate, DateTimeInterface $toDate, array $data = array()
    )
    {
        $data['session'] = $this->getConfig()->getAuth()->getTokenId();

        $data['module_name'] = $moduleName;

        $data['related_module'] = $relatedModule;

        $data['from_date'] = $fromDate->format('Y-m-d H:i:s');

        $data['to_date'] = $toDate->format('Y-m-d H:i:s');

        $data['offset'] = isset($data['offset']) ? $data['offset'] : 0;

        $data['max_results'] = isset($data['max_results']) ? $data['max_results'] : 20;

        $data['deleted'] = isset($data['deleted']) ? $data['deleted'] : false;

        $data['module_user_id'] = isset($data['module_user_id']) ? $data['module_user_id'] : '';

        $data['select_fields'] = isset($data['select_fields']) ? $data['select_fields'] : array();

        $data['relationship_name'] = isset($data['relationship_name']) ? $data['relationship_name'] : '';

        $data['deletion_date'] = isset($data['deletion_date']) ? $data['deletion_date'] : '';

        return $this->getConfig()->getHttp()->sendData('get_modified_relationships', $data);
    }

    public function getModuleFields($moduleName, array $data = array())
    {
        $data['session'] = $this->getConfig()->getAuth()->getTokenId();

        $data['module_name'] = $moduleName;

        $data['fields'] = isset($data['fields']) ? $data['fields'] : array();

        return $this->getConfig()->getHttp()->sendData('get_module_fields', $data);
    }

    public function getModuleFieldsMd5(array $moduleNames)
    {
        $data = array(
            'session' => $this->getConfig()->getAuth()->getTokenId(),
            'module_names' => $moduleNames,
        );

        return $this->getConfig()->getHttp()->sendData('get_module_fields_md5', $data);
    }

    public function getModuleLayout(array $modules, array $data = array())
    {
        $data['session'] = $this->getConfig()->getAuth()->getTokenId();

        $data['modules'] = $modules;

        $data['types'] = isset($data['types']) ? $data['types'] : array();

        $data['views'] = isset($data['views']) ? $data['views'] : array();

        $data['acl_check'] = isset($data['acl_check']) ? $data['acl_check'] : false;

        $data['md5'] = isset($data['md5']) ? $data['md5'] : false;

        return $this->getConfig()->getHttp()->sendData('get_module_layout', $data);
    }

    public function getModuleLayoutMd5(array $modules, array $data = array())
    {
        $data['session'] = $this->getConfig()->getAuth()->getTokenId();

        $data['modules'] = $modules;

        $data['types'] = isset($data['types']) ? $data['types'] : array();

        $data['views'] = isset($data['views']) ? $data['views'] : array();

        $data['acl_check'] = isset($data['acl_check']) ? $data['acl_check'] : false;

        return $this->getConfig()->getHttp()->sendData('get_module_layout_md5', $data);
    }

    public function getRelationships($moduleName, $moduleId, $linkFieldName, $data = array())
    {
        $data['session'] = $this->getConfig()->getAuth()->getTokenId();

        $data['module_name'] = $moduleName;

        $data['module_id'] = $moduleId;

        $data['link_field_name'] = $linkFieldName;

        $data['related_module_query'] = isset($data['related_module_query']) ? $data['related_module_query'] : '';

        if (!isset($data['related_fields'])) {
            $data['related_fields'] = array('id','first_name');
        }

        $data['related_module_link_name_to_fields_array'] = isset($data['related_module_link_name_to_fields_array']) ? $data['related_module_link_name_to_fields_array'] : array();

        $data['deleted'] = isset($data['deleted']) ? $data['deleted'] : false;

        $data['order_by'] = isset($data['order_by']) ? $data['order_by'] : '';

        $data['offset'] = isset($data['offset']) ? $data['offset'] : 0;

        $data['limit'] = isset($data['limit']) ? $data['limit'] : 100;

        return $this->getConfig()->getHttp()->sendData('get_relationships', $data);
    }

    public function getServerInfo()
    {
        return $this->getConfig()->getHttp()->sendData('get_server_info');
    }

    public function getUpcomingActivities()
    {
        $data = array(
            'session' => $this->getConfig()->getAuth()->getTokenId(),
        );

        return $this->getConfig()->getHttp()->sendData('get_upcoming_activities', $data);
    }

    public function getUserId()
    {
        $data = array(
            'session' => $this->getConfig()->getAuth()->getTokenId(),
        );

        return $this->getConfig()->getHttp()->sendData('get_user_id', $data);
    }

    public function seamlessLogin()
    {
        $data = array(
            'session' => $this->getConfig()->getAuth()->getTokenId(),
        );

        return $this->getConfig()->getHttp()->sendData('seamless_login', $data);
    }

    public function searchByModule($searchString, array $modules = array(), $data = array())
    {
        $data['session'] = $this->getConfig()->getAuth()->getTokenId();

        $data['search_string'] = $searchString;

        $data['modules'] = $modules;

        $data['offset'] = isset($data['offset']) ? $data['offset'] : 0;

        $data['max_results'] = isset($data['max_results']) ? $data['max_results'] : 20;

        $data['assigned_user_id'] = isset($data['assigned_user_id']) ? $data['assigned_user_id'] : '';

        $data['select_fields'] = isset($data['select_fields']) ? $data['select_fields'] : array();

        $data['unified_search_only'] = isset($data['unified_search_only']) ? $data['unified_search_only'] : false;

        return $this->getConfig()->getHttp()->sendData('search_by_module', $data);
    }

    public function setDocumentRevision(array $note = array())
    {
        $data = array();

        $data['session'] = $this->getConfig()->getAuth()->getTokenId();

        $data['note'] = array(
            'id' => isset($note['id']) ? $note['id'] : '',
            'file' => isset($note['file']) ? $note['file'] : '',
            'filename' => isset($note['filename']) ? $note['filename'] : '',
            'revision' => isset($note['revision']) ? $note['revision'] : 1
        );

        return $this->getConfig()->getHttp()->sendData('set_document_revision', $data);
    }

    public function setEntries($moduleName, array $valueList)
    {
        $data = array();

        $data['session'] = $this->getConfig()->getAuth()->getTokenId();

        $data['module_name'] = $moduleName;

        $data['name_value_lists'] = array();

        foreach ($valueList as $list) {
            $entry = array();

            foreach ($list as $key => $value) {
                $entry[$key] = $value;
            }

            $data['name_value_lists'][] = $entry;
        }

        return $this->getConfig()->getHttp()->sendData('set_entries', $data);
    }

    public function setEntry($moduleName, $moduleId, array $valueList = array())
    {
        $data = array();

        $data['session'] = $this->getConfig()->getAuth()->getTokenId();

        $data['module_name'] = $moduleName;

        $data['name_value_list'] = array();

        $data['name_value_list']['id'] = $moduleId;

        foreach ($valueList as $key => $value) {
            $data['name_value_list'][$key] = $value;
        }

        return $this->getConfig()->getHttp()->sendData('set_entry', $data);
    }

    public function getNoteAttachment($id)
    {
        $data = array(
            'session' => $this->getConfig()->getAuth()->getTokenId(),
            'id' => $id,
        );

        return $this->getConfig()->getHttp()->sendData('get_note_attachment', $data);
    }

    public function setNoteAttachment($noteId, $filename, $fileContent)
    {
        $data = array();

        $data['session'] = $this->getConfig()->getAuth()->getTokenId();

        $data['note'] = array(
            'id' => $noteId,
            'filename' => $filename,
            'file' => base64_encode($fileContent),
        );

        return $this->getConfig()->getHttp()->sendData('set_note_attachment', $data);
    }

    public function setRelationship($moduleName, $moduleId, $linkFieldName, array $relatedIds = array(), array $nameValueList = array(), $delete = false)
    {
        $data = array();

        $data['session'] = $this->getConfig()->getAuth()->getTokenId();

        $data['module_name'] = $moduleName;

        $data['module_id'] = $moduleId;

        $data['link_field_name'] = $linkFieldName;

        $data['related_ids'] = $relatedIds;

        $data['name_value_list'] = $nameValueList;

        $data['delete'] = $delete;

        return $this->getConfig()->getHttp()->sendData('set_relationship', $data);
    }

    public function setRelationships(array $moduleNames = array(), array $moduleIds = array(), array $linkFieldNames = array(), array $relatedIds = array(), array $nameValueLists = array(), array $deleteArray = array())
    {
        $data = array();

        $data['session'] = $this->getConfig()->getAuth()->getTokenId();

        $data['module_names'] = $moduleNames;

        $data['module_ids'] = $moduleIds;

        $data['link_field_names'] = $linkFieldNames;

        $data['related_ids'] = $relatedIds;

        $data['name_value_lists'] = $nameValueLists;

        $data['delete_array'] = $deleteArray;

        return $this->getConfig()->getHttp()->sendData('set_relationships', $data);
    }
}
