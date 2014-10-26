<?php

namespace Map;

use \RegisteredUser;
use \RegisteredUserQuery;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\InstancePoolTrait;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\DataFetcher\DataFetcherInterface;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\RelationMap;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Map\TableMapTrait;


/**
 * This class defines the structure of the 'RegisteredUser' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class RegisteredUserTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.RegisteredUserTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'chatstorm';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'RegisteredUser';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\RegisteredUser';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'RegisteredUser';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 12;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 12;

    /**
     * the column name for the RegisteredUserId field
     */
    const COL_REGISTEREDUSERID = 'RegisteredUser.RegisteredUserId';

    /**
     * the column name for the Email field
     */
    const COL_EMAIL = 'RegisteredUser.Email';

    /**
     * the column name for the PasswordHash field
     */
    const COL_PASSWORDHASH = 'RegisteredUser.PasswordHash';

    /**
     * the column name for the ActivationKey field
     */
    const COL_ACTIVATIONKEY = 'RegisteredUser.ActivationKey';

    /**
     * the column name for the RegisteredDate field
     */
    const COL_REGISTEREDDATE = 'RegisteredUser.RegisteredDate';

    /**
     * the column name for the ActivationDate field
     */
    const COL_ACTIVATIONDATE = 'RegisteredUser.ActivationDate';

    /**
     * the column name for the Activated field
     */
    const COL_ACTIVATED = 'RegisteredUser.Activated';

    /**
     * the column name for the Rating field
     */
    const COL_RATING = 'RegisteredUser.Rating';

    /**
     * the column name for the LocationLatitude field
     */
    const COL_LOCATIONLATITUDE = 'RegisteredUser.LocationLatitude';

    /**
     * the column name for the LocationLongitude field
     */
    const COL_LOCATIONLONGITUDE = 'RegisteredUser.LocationLongitude';

    /**
     * the column name for the LocationAccuracy field
     */
    const COL_LOCATIONACCURACY = 'RegisteredUser.LocationAccuracy';

    /**
     * the column name for the IMEI field
     */
    const COL_IMEI = 'RegisteredUser.IMEI';

    /**
     * The default string format for model objects of the related table
     */
    const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        self::TYPE_PHPNAME       => array('Registereduserid', 'Email', 'Passwordhash', 'Activationkey', 'Registereddate', 'Activationdate', 'Activated', 'Rating', 'Locationlatitude', 'Locationlongitude', 'Locationaccuracy', 'Imei', ),
        self::TYPE_CAMELNAME     => array('registereduserid', 'email', 'passwordhash', 'activationkey', 'registereddate', 'activationdate', 'activated', 'rating', 'locationlatitude', 'locationlongitude', 'locationaccuracy', 'imei', ),
        self::TYPE_COLNAME       => array(RegisteredUserTableMap::COL_REGISTEREDUSERID, RegisteredUserTableMap::COL_EMAIL, RegisteredUserTableMap::COL_PASSWORDHASH, RegisteredUserTableMap::COL_ACTIVATIONKEY, RegisteredUserTableMap::COL_REGISTEREDDATE, RegisteredUserTableMap::COL_ACTIVATIONDATE, RegisteredUserTableMap::COL_ACTIVATED, RegisteredUserTableMap::COL_RATING, RegisteredUserTableMap::COL_LOCATIONLATITUDE, RegisteredUserTableMap::COL_LOCATIONLONGITUDE, RegisteredUserTableMap::COL_LOCATIONACCURACY, RegisteredUserTableMap::COL_IMEI, ),
        self::TYPE_FIELDNAME     => array('RegisteredUserId', 'Email', 'PasswordHash', 'ActivationKey', 'RegisteredDate', 'ActivationDate', 'Activated', 'Rating', 'LocationLatitude', 'LocationLongitude', 'LocationAccuracy', 'IMEI', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Registereduserid' => 0, 'Email' => 1, 'Passwordhash' => 2, 'Activationkey' => 3, 'Registereddate' => 4, 'Activationdate' => 5, 'Activated' => 6, 'Rating' => 7, 'Locationlatitude' => 8, 'Locationlongitude' => 9, 'Locationaccuracy' => 10, 'Imei' => 11, ),
        self::TYPE_CAMELNAME     => array('registereduserid' => 0, 'email' => 1, 'passwordhash' => 2, 'activationkey' => 3, 'registereddate' => 4, 'activationdate' => 5, 'activated' => 6, 'rating' => 7, 'locationlatitude' => 8, 'locationlongitude' => 9, 'locationaccuracy' => 10, 'imei' => 11, ),
        self::TYPE_COLNAME       => array(RegisteredUserTableMap::COL_REGISTEREDUSERID => 0, RegisteredUserTableMap::COL_EMAIL => 1, RegisteredUserTableMap::COL_PASSWORDHASH => 2, RegisteredUserTableMap::COL_ACTIVATIONKEY => 3, RegisteredUserTableMap::COL_REGISTEREDDATE => 4, RegisteredUserTableMap::COL_ACTIVATIONDATE => 5, RegisteredUserTableMap::COL_ACTIVATED => 6, RegisteredUserTableMap::COL_RATING => 7, RegisteredUserTableMap::COL_LOCATIONLATITUDE => 8, RegisteredUserTableMap::COL_LOCATIONLONGITUDE => 9, RegisteredUserTableMap::COL_LOCATIONACCURACY => 10, RegisteredUserTableMap::COL_IMEI => 11, ),
        self::TYPE_FIELDNAME     => array('RegisteredUserId' => 0, 'Email' => 1, 'PasswordHash' => 2, 'ActivationKey' => 3, 'RegisteredDate' => 4, 'ActivationDate' => 5, 'Activated' => 6, 'Rating' => 7, 'LocationLatitude' => 8, 'LocationLongitude' => 9, 'LocationAccuracy' => 10, 'IMEI' => 11, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, )
    );

    /**
     * Initialize the table attributes and columns
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws PropelException
     */
    public function initialize()
    {
        // attributes
        $this->setName('RegisteredUser');
        $this->setPhpName('RegisteredUser');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\RegisteredUser');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('RegisteredUserId', 'Registereduserid', 'INTEGER', true, null, null);
        $this->addColumn('Email', 'Email', 'VARCHAR', true, 255, null);
        $this->addColumn('PasswordHash', 'Passwordhash', 'VARCHAR', true, 64, null);
        $this->addColumn('ActivationKey', 'Activationkey', 'VARCHAR', true, 25, null);
        $this->addColumn('RegisteredDate', 'Registereddate', 'TIMESTAMP', true, null, null);
        $this->addColumn('ActivationDate', 'Activationdate', 'TIMESTAMP', false, null, null);
        $this->addColumn('Activated', 'Activated', 'BOOLEAN', true, 1, null);
        $this->addColumn('Rating', 'Rating', 'INTEGER', true, null, null);
        $this->addColumn('LocationLatitude', 'Locationlatitude', 'DOUBLE', true, null, null);
        $this->addColumn('LocationLongitude', 'Locationlongitude', 'DOUBLE', true, null, null);
        $this->addColumn('LocationAccuracy', 'Locationaccuracy', 'INTEGER', true, null, null);
        $this->addColumn('IMEI', 'Imei', 'VARCHAR', true, 64, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('RoomUser', '\\RoomUser', RelationMap::ONE_TO_MANY, array('RegisteredUserId' => 'RegisteredUserId', ), null, null, 'RoomUsers');
    } // buildRelations()

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return string The primary key hash of the row
     */
    public static function getPrimaryKeyHashFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        // If the PK cannot be derived from the row, return NULL.
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Registereduserid', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Registereduserid', TableMap::TYPE_PHPNAME, $indexType)];
    }

    /**
     * Retrieves the primary key from the DB resultset row
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, an array of the primary key columns will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return mixed The primary key of the row
     */
    public static function getPrimaryKeyFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        return (int) $row[
            $indexType == TableMap::TYPE_NUM
                ? 0 + $offset
                : self::translateFieldName('Registereduserid', TableMap::TYPE_PHPNAME, $indexType)
        ];
    }

    /**
     * The class that the tableMap will make instances of.
     *
     * If $withPrefix is true, the returned path
     * uses a dot-path notation which is translated into a path
     * relative to a location on the PHP include_path.
     * (e.g. path.to.MyClass -> 'path/to/MyClass.php')
     *
     * @param boolean $withPrefix Whether or not to return the path with the class name
     * @return string path.to.ClassName
     */
    public static function getOMClass($withPrefix = true)
    {
        return $withPrefix ? RegisteredUserTableMap::CLASS_DEFAULT : RegisteredUserTableMap::OM_CLASS;
    }

    /**
     * Populates an object of the default type or an object that inherit from the default.
     *
     * @param array  $row       row returned by DataFetcher->fetch().
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                 One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return array           (RegisteredUser object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = RegisteredUserTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = RegisteredUserTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + RegisteredUserTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = RegisteredUserTableMap::OM_CLASS;
            /** @var RegisteredUser $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            RegisteredUserTableMap::addInstanceToPool($obj, $key);
        }

        return array($obj, $col);
    }

    /**
     * The returned array will contain objects of the default type or
     * objects that inherit from the default.
     *
     * @param DataFetcherInterface $dataFetcher
     * @return array
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function populateObjects(DataFetcherInterface $dataFetcher)
    {
        $results = array();

        // set the class once to avoid overhead in the loop
        $cls = static::getOMClass(false);
        // populate the object(s)
        while ($row = $dataFetcher->fetch()) {
            $key = RegisteredUserTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = RegisteredUserTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var RegisteredUser $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                RegisteredUserTableMap::addInstanceToPool($obj, $key);
            } // if key exists
        }

        return $results;
    }
    /**
     * Add all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be added to the select list and only loaded
     * on demand.
     *
     * @param Criteria $criteria object containing the columns to add.
     * @param string   $alias    optional table alias
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function addSelectColumns(Criteria $criteria, $alias = null)
    {
        if (null === $alias) {
            $criteria->addSelectColumn(RegisteredUserTableMap::COL_REGISTEREDUSERID);
            $criteria->addSelectColumn(RegisteredUserTableMap::COL_EMAIL);
            $criteria->addSelectColumn(RegisteredUserTableMap::COL_PASSWORDHASH);
            $criteria->addSelectColumn(RegisteredUserTableMap::COL_ACTIVATIONKEY);
            $criteria->addSelectColumn(RegisteredUserTableMap::COL_REGISTEREDDATE);
            $criteria->addSelectColumn(RegisteredUserTableMap::COL_ACTIVATIONDATE);
            $criteria->addSelectColumn(RegisteredUserTableMap::COL_ACTIVATED);
            $criteria->addSelectColumn(RegisteredUserTableMap::COL_RATING);
            $criteria->addSelectColumn(RegisteredUserTableMap::COL_LOCATIONLATITUDE);
            $criteria->addSelectColumn(RegisteredUserTableMap::COL_LOCATIONLONGITUDE);
            $criteria->addSelectColumn(RegisteredUserTableMap::COL_LOCATIONACCURACY);
            $criteria->addSelectColumn(RegisteredUserTableMap::COL_IMEI);
        } else {
            $criteria->addSelectColumn($alias . '.RegisteredUserId');
            $criteria->addSelectColumn($alias . '.Email');
            $criteria->addSelectColumn($alias . '.PasswordHash');
            $criteria->addSelectColumn($alias . '.ActivationKey');
            $criteria->addSelectColumn($alias . '.RegisteredDate');
            $criteria->addSelectColumn($alias . '.ActivationDate');
            $criteria->addSelectColumn($alias . '.Activated');
            $criteria->addSelectColumn($alias . '.Rating');
            $criteria->addSelectColumn($alias . '.LocationLatitude');
            $criteria->addSelectColumn($alias . '.LocationLongitude');
            $criteria->addSelectColumn($alias . '.LocationAccuracy');
            $criteria->addSelectColumn($alias . '.IMEI');
        }
    }

    /**
     * Returns the TableMap related to this object.
     * This method is not needed for general use but a specific application could have a need.
     * @return TableMap
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function getTableMap()
    {
        return Propel::getServiceContainer()->getDatabaseMap(RegisteredUserTableMap::DATABASE_NAME)->getTable(RegisteredUserTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(RegisteredUserTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(RegisteredUserTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new RegisteredUserTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a RegisteredUser or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or RegisteredUser object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param  ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
     public static function doDelete($values, ConnectionInterface $con = null)
     {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(RegisteredUserTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \RegisteredUser) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(RegisteredUserTableMap::DATABASE_NAME);
            $criteria->add(RegisteredUserTableMap::COL_REGISTEREDUSERID, (array) $values, Criteria::IN);
        }

        $query = RegisteredUserQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            RegisteredUserTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                RegisteredUserTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the RegisteredUser table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return RegisteredUserQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a RegisteredUser or Criteria object.
     *
     * @param mixed               $criteria Criteria or RegisteredUser object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(RegisteredUserTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from RegisteredUser object
        }

        if ($criteria->containsKey(RegisteredUserTableMap::COL_REGISTEREDUSERID) && $criteria->keyContainsValue(RegisteredUserTableMap::COL_REGISTEREDUSERID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.RegisteredUserTableMap::COL_REGISTEREDUSERID.')');
        }


        // Set the correct dbName
        $query = RegisteredUserQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // RegisteredUserTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
RegisteredUserTableMap::buildTableMap();
