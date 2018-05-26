<?php

/**
 * Interface LoggerInterface
 */
interface LoggerInterface
{
    /**
     * @return array
     */
    public function getDbFieldMapping();

    /**
     * @return string
     */
    public function getDbTableName();

    /**
     * @return string
     */
    public function getPrimaryKeyName();

    /**
     * @param int $id
     * @return array
     */
    public function getOldValues($id);

    /**
     * @param int $id
     * @return array
     */
    public function getNewValues($id);

    /**
     * @param int $id
     * @return array
     */
    public function getDbValues($id);
}
