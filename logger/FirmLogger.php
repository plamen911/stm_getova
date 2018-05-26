<?php
require_once ('LoggerInterface.php');

/**
 * Class FirmLogger
 * @author Plamen Markov <plamen@lynxlake.org>
 */
class FirmLogger implements LoggerInterface
{
    /** @var array $oldValues */
    private $oldValues;
    /** @var array $oldValues */
    private $newValues;

    /**
     * FirmLogger constructor.
     */
    public function __construct()
    {
        $this->oldValues = [];
        $this->newValues = [];
    }

    /**
     * @return array
     */
    public function getDbFieldMapping()
    {
        return [
            'is_active' => 'Активна',
            'name' => 'Наименование',
            'location_name' => 'Населено място',
            'community_name' => 'Община',
            'province_name' => 'Област',
            'address' => 'Адрес',
            'notes' => 'Бележки',
            'phone1' => 'Тел. 1',
            'phone2' => 'Тел. 2',
            'bulstat' => 'БУЛСТАТ',
            'email' => 'E-mail',
            'contract_num' => 'Договор рег. №',
            'contract_begin' => 'Дата на сключване',
            'contract_end' => 'Дата на изтичане'
        ];
    }

    /**
     * @return string
     */
    public function getDbTableName()
    {
        return 'firms';
    }

    /**
     * @return string
     */
    public function getPrimaryKeyName()
    {
        return 'firm_id';
    }

    /**
     * @param int $id
     * @return array
     */
    public function getOldValues($id)
    {
        $this->oldValues = $this->getDbValues($id);
        return $this->oldValues;
    }

    /**
     * @param int $id
     * @return array
     */
    public function getNewValues($id)
    {
        $this->newValues = $this->getDbValues($id);
        return $this->newValues;
    }

    /**
     * @param int $id
     * @return array
     */
    public function getDbValues($id)
    {
        return ORM::for_table($this->getDbTableName())
            ->select(array_keys($this->getDbFieldMapping()))
            ->where($this->getPrimaryKeyName(), $id)
            ->find_array();
    }
}
