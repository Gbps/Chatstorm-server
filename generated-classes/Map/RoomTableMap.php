<?php

namespace Map;

use \Room;
use \RoomQuery;
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
 * This class defines the structure of the 'Room' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class RoomTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.RoomTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'chatstorm';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'Room';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\Room';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'Room';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 8;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 8;

    /**
     * the column name for the RoomId field
     */
    const COL_ROOMID = 'Room.RoomId';

    /**
     * the column name for the CreatedDate field
     */
    const COL_CREATEDDATE = 'Room.CreatedDate';

    /**
     * the column name for the Timeout field
     */
    const COL_TIMEOUT = 'Room.Timeout';

    /**
     * the column name for the RoomUsersId field
     */
    const COL_ROOMUSERSID = 'Room.RoomUsersId';

    /**
     * the column name for the Rating field
     */
    const COL_RATING = 'Room.Rating';

    /**
     * the column name for the LocationLatitude field
     */
    const COL_LOCATIONLATITUDE = 'Room.LocationLatitude';

    /**
     * the column name for the LocationLongitude field
     */
    const COL_LOCATIONLONGITUDE = 'Room.LocationLongitude';

    /**
     * the column name for the LocationAccuracy field
     */
    const COL_LOCATIONACCURACY = 'Room.LocationAccuracy';

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
        self::TYPE_PHPNAME       => array('Roomid', 'Createddate', 'Timeout', 'Roomusersid', 'Rating', 'Locationlatitude', 'Locationlongitude', 'Locationaccuracy', ),
        self::TYPE_CAMELNAME     => array('roomid', 'createddate', 'timeout', 'roomusersid', 'rating', 'locationlatitude', 'locationlongitude', 'locationaccuracy', ),
        self::TYPE_COLNAME       => array(RoomTableMap::COL_ROOMID, RoomTableMap::COL_CREATEDDATE, RoomTableMap::COL_TIMEOUT, RoomTableMap::COL_ROOMUSERSID, RoomTableMap::COL_RATING, RoomTableMap::COL_LOCATIONLATITUDE, RoomTableMap::COL_LOCATIONLONGITUDE, RoomTableMap::COL_LOCATIONACCURACY, ),
        self::TYPE_FIELDNAME     => array('RoomId', 'CreatedDate', 'Timeout', 'RoomUsersId', 'Rating', 'LocationLatitude', 'LocationLongitude', 'LocationAccuracy', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Roomid' => 0, 'Createddate' => 1, 'Timeout' => 2, 'Roomusersid' => 3, 'Rating' => 4, 'Locationlatitude' => 5, 'Locationlongitude' => 6, 'Locationaccuracy' => 7, ),
        self::TYPE_CAMELNAME     => array('roomid' => 0, 'createddate' => 1, 'timeout' => 2, 'roomusersid' => 3, 'rating' => 4, 'locationlatitude' => 5, 'locationlongitude' => 6, 'locationaccuracy' => 7, ),
        self::TYPE_COLNAME       => array(RoomTableMap::COL_ROOMID => 0, RoomTableMap::COL_CREATEDDATE => 1, RoomTableMap::COL_TIMEOUT => 2, RoomTableMap::COL_ROOMUSERSID => 3, RoomTableMap::COL_RATING => 4, RoomTableMap::COL_LOCATIONLATITUDE => 5, RoomTableMap::COL_LOCATIONLONGITUDE => 6, RoomTableMap::COL_LOCATIONACCURACY => 7, ),
        self::TYPE_FIELDNAME     => array('RoomId' => 0, 'CreatedDate' => 1, 'Timeout' => 2, 'RoomUsersId' => 3, 'Rating' => 4, 'LocationLatitude' => 5, 'LocationLongitude' => 6, 'LocationAccuracy' => 7, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, )
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
        $this->setName('Room');
        $this->setPhpName('Room');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Room');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('RoomId', 'Roomid', 'INTEGER', true, null, null);
        $this->addColumn('CreatedDate', 'Createddate', 'TIMESTAMP', true, null, null);
        $this->addColumn('Timeout', 'Timeout', 'TIMESTAMP', true, null, null);
        $this->addColumn('RoomUsersId', 'Roomusersid', 'INTEGER', true, null, null);
        $this->addColumn('Rating', 'Rating', 'INTEGER', true, null, null);
        $this->addColumn('LocationLatitude', 'Locationlatitude', 'DOUBLE', true, null, null);
        $this->addColumn('LocationLongitude', 'Locationlongitude', 'DOUBLE', true, null, null);
        $this->addColumn('LocationAccuracy', 'Locationaccuracy', 'INTEGER', true, null, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Message', '\\Message', RelationMap::ONE_TO_MANY, array('RoomId' => 'RoomId', ), null, null, 'Messages');
        $this->addRelation('RoomUser', '\\RoomUser', RelationMap::ONE_TO_MANY, array('RoomId' => 'RoomId', ), null, null, 'RoomUsers');
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Roomid', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Roomid', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('Roomid', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? RoomTableMap::CLASS_DEFAULT : RoomTableMap::OM_CLASS;
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
     * @return array           (Room object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = RoomTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = RoomTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + RoomTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = RoomTableMap::OM_CLASS;
            /** @var Room $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            RoomTableMap::addInstanceToPool($obj, $key);
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
            $key = RoomTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = RoomTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Room $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                RoomTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(RoomTableMap::COL_ROOMID);
            $criteria->addSelectColumn(RoomTableMap::COL_CREATEDDATE);
            $criteria->addSelectColumn(RoomTableMap::COL_TIMEOUT);
            $criteria->addSelectColumn(RoomTableMap::COL_ROOMUSERSID);
            $criteria->addSelectColumn(RoomTableMap::COL_RATING);
            $criteria->addSelectColumn(RoomTableMap::COL_LOCATIONLATITUDE);
            $criteria->addSelectColumn(RoomTableMap::COL_LOCATIONLONGITUDE);
            $criteria->addSelectColumn(RoomTableMap::COL_LOCATIONACCURACY);
        } else {
            $criteria->addSelectColumn($alias . '.RoomId');
            $criteria->addSelectColumn($alias . '.CreatedDate');
            $criteria->addSelectColumn($alias . '.Timeout');
            $criteria->addSelectColumn($alias . '.RoomUsersId');
            $criteria->addSelectColumn($alias . '.Rating');
            $criteria->addSelectColumn($alias . '.LocationLatitude');
            $criteria->addSelectColumn($alias . '.LocationLongitude');
            $criteria->addSelectColumn($alias . '.LocationAccuracy');
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
        return Propel::getServiceContainer()->getDatabaseMap(RoomTableMap::DATABASE_NAME)->getTable(RoomTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(RoomTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(RoomTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new RoomTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Room or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Room object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(RoomTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Room) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(RoomTableMap::DATABASE_NAME);
            $criteria->add(RoomTableMap::COL_ROOMID, (array) $values, Criteria::IN);
        }

        $query = RoomQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            RoomTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                RoomTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the Room table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return RoomQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Room or Criteria object.
     *
     * @param mixed               $criteria Criteria or Room object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(RoomTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Room object
        }

        if ($criteria->containsKey(RoomTableMap::COL_ROOMID) && $criteria->keyContainsValue(RoomTableMap::COL_ROOMID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.RoomTableMap::COL_ROOMID.')');
        }


        // Set the correct dbName
        $query = RoomQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // RoomTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
RoomTableMap::buildTableMap();
