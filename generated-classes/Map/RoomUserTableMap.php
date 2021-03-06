<?php

namespace Map;

use \RoomUser;
use \RoomUserQuery;
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
 * This class defines the structure of the 'RoomUser' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class RoomUserTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.RoomUserTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'chatstorm';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'RoomUser';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\RoomUser';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'RoomUser';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 5;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 5;

    /**
     * the column name for the RoomUserId field
     */
    const COL_ROOMUSERID = 'RoomUser.RoomUserId';

    /**
     * the column name for the VisibleName field
     */
    const COL_VISIBLENAME = 'RoomUser.VisibleName';

    /**
     * the column name for the RegisteredUserId field
     */
    const COL_REGISTEREDUSERID = 'RoomUser.RegisteredUserId';

    /**
     * the column name for the HasVoted field
     */
    const COL_HASVOTED = 'RoomUser.HasVoted';

    /**
     * the column name for the RoomId field
     */
    const COL_ROOMID = 'RoomUser.RoomId';

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
        self::TYPE_PHPNAME       => array('Roomuserid', 'Visiblename', 'Registereduserid', 'Hasvoted', 'Roomid', ),
        self::TYPE_CAMELNAME     => array('roomuserid', 'visiblename', 'registereduserid', 'hasvoted', 'roomid', ),
        self::TYPE_COLNAME       => array(RoomUserTableMap::COL_ROOMUSERID, RoomUserTableMap::COL_VISIBLENAME, RoomUserTableMap::COL_REGISTEREDUSERID, RoomUserTableMap::COL_HASVOTED, RoomUserTableMap::COL_ROOMID, ),
        self::TYPE_FIELDNAME     => array('RoomUserId', 'VisibleName', 'RegisteredUserId', 'HasVoted', 'RoomId', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Roomuserid' => 0, 'Visiblename' => 1, 'Registereduserid' => 2, 'Hasvoted' => 3, 'Roomid' => 4, ),
        self::TYPE_CAMELNAME     => array('roomuserid' => 0, 'visiblename' => 1, 'registereduserid' => 2, 'hasvoted' => 3, 'roomid' => 4, ),
        self::TYPE_COLNAME       => array(RoomUserTableMap::COL_ROOMUSERID => 0, RoomUserTableMap::COL_VISIBLENAME => 1, RoomUserTableMap::COL_REGISTEREDUSERID => 2, RoomUserTableMap::COL_HASVOTED => 3, RoomUserTableMap::COL_ROOMID => 4, ),
        self::TYPE_FIELDNAME     => array('RoomUserId' => 0, 'VisibleName' => 1, 'RegisteredUserId' => 2, 'HasVoted' => 3, 'RoomId' => 4, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, )
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
        $this->setName('RoomUser');
        $this->setPhpName('RoomUser');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\RoomUser');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('RoomUserId', 'Roomuserid', 'INTEGER', true, null, null);
        $this->addColumn('VisibleName', 'Visiblename', 'VARCHAR', true, 32, null);
        $this->addForeignPrimaryKey('RegisteredUserId', 'Registereduserid', 'INTEGER' , 'RegisteredUser', 'RegisteredUserId', true, null, null);
        $this->addColumn('HasVoted', 'Hasvoted', 'BOOLEAN', true, 1, null);
        $this->addForeignPrimaryKey('RoomId', 'Roomid', 'INTEGER' , 'Room', 'RoomId', true, null, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('RegisteredUser', '\\RegisteredUser', RelationMap::MANY_TO_ONE, array('RegisteredUserId' => 'RegisteredUserId', ), null, null);
        $this->addRelation('Room', '\\Room', RelationMap::MANY_TO_ONE, array('RoomId' => 'RoomId', ), null, null);
    } // buildRelations()

    /**
     * Adds an object to the instance pool.
     *
     * Propel keeps cached copies of objects in an instance pool when they are retrieved
     * from the database. In some cases you may need to explicitly add objects
     * to the cache in order to ensure that the same objects are always returned by find*()
     * and findPk*() calls.
     *
     * @param \RoomUser $obj A \RoomUser object.
     * @param string $key             (optional) key to use for instance map (for performance boost if key was already calculated externally).
     */
    public static function addInstanceToPool($obj, $key = null)
    {
        if (Propel::isInstancePoolingEnabled()) {
            if (null === $key) {
                $key = serialize(array((string) $obj->getRoomuserid(), (string) $obj->getRegistereduserid(), (string) $obj->getRoomid()));
            } // if key === null
            self::$instances[$key] = $obj;
        }
    }

    /**
     * Removes an object from the instance pool.
     *
     * Propel keeps cached copies of objects in an instance pool when they are retrieved
     * from the database.  In some cases -- especially when you override doDelete
     * methods in your stub classes -- you may need to explicitly remove objects
     * from the cache in order to prevent returning objects that no longer exist.
     *
     * @param mixed $value A \RoomUser object or a primary key value.
     */
    public static function removeInstanceFromPool($value)
    {
        if (Propel::isInstancePoolingEnabled() && null !== $value) {
            if (is_object($value) && $value instanceof \RoomUser) {
                $key = serialize(array((string) $value->getRoomuserid(), (string) $value->getRegistereduserid(), (string) $value->getRoomid()));

            } elseif (is_array($value) && count($value) === 3) {
                // assume we've been passed a primary key";
                $key = serialize(array((string) $value[0], (string) $value[1], (string) $value[2]));
            } elseif ($value instanceof Criteria) {
                self::$instances = [];

                return;
            } else {
                $e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or \RoomUser object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value, true)));
                throw $e;
            }

            unset(self::$instances[$key]);
        }
    }

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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Roomuserid', TableMap::TYPE_PHPNAME, $indexType)] === null && $row[TableMap::TYPE_NUM == $indexType ? 2 + $offset : static::translateFieldName('Registereduserid', TableMap::TYPE_PHPNAME, $indexType)] === null && $row[TableMap::TYPE_NUM == $indexType ? 4 + $offset : static::translateFieldName('Roomid', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return serialize(array((string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Roomuserid', TableMap::TYPE_PHPNAME, $indexType)], (string) $row[TableMap::TYPE_NUM == $indexType ? 2 + $offset : static::translateFieldName('Registereduserid', TableMap::TYPE_PHPNAME, $indexType)], (string) $row[TableMap::TYPE_NUM == $indexType ? 4 + $offset : static::translateFieldName('Roomid', TableMap::TYPE_PHPNAME, $indexType)]));
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
            $pks = [];

        $pks[] = (int) $row[
            $indexType == TableMap::TYPE_NUM
                ? 0 + $offset
                : self::translateFieldName('Roomuserid', TableMap::TYPE_PHPNAME, $indexType)
        ];
        $pks[] = (int) $row[
            $indexType == TableMap::TYPE_NUM
                ? 2 + $offset
                : self::translateFieldName('Registereduserid', TableMap::TYPE_PHPNAME, $indexType)
        ];
        $pks[] = (int) $row[
            $indexType == TableMap::TYPE_NUM
                ? 4 + $offset
                : self::translateFieldName('Roomid', TableMap::TYPE_PHPNAME, $indexType)
        ];

        return $pks;
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
        return $withPrefix ? RoomUserTableMap::CLASS_DEFAULT : RoomUserTableMap::OM_CLASS;
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
     * @return array           (RoomUser object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = RoomUserTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = RoomUserTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + RoomUserTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = RoomUserTableMap::OM_CLASS;
            /** @var RoomUser $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            RoomUserTableMap::addInstanceToPool($obj, $key);
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
            $key = RoomUserTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = RoomUserTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var RoomUser $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                RoomUserTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(RoomUserTableMap::COL_ROOMUSERID);
            $criteria->addSelectColumn(RoomUserTableMap::COL_VISIBLENAME);
            $criteria->addSelectColumn(RoomUserTableMap::COL_REGISTEREDUSERID);
            $criteria->addSelectColumn(RoomUserTableMap::COL_HASVOTED);
            $criteria->addSelectColumn(RoomUserTableMap::COL_ROOMID);
        } else {
            $criteria->addSelectColumn($alias . '.RoomUserId');
            $criteria->addSelectColumn($alias . '.VisibleName');
            $criteria->addSelectColumn($alias . '.RegisteredUserId');
            $criteria->addSelectColumn($alias . '.HasVoted');
            $criteria->addSelectColumn($alias . '.RoomId');
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
        return Propel::getServiceContainer()->getDatabaseMap(RoomUserTableMap::DATABASE_NAME)->getTable(RoomUserTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(RoomUserTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(RoomUserTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new RoomUserTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a RoomUser or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or RoomUser object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(RoomUserTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \RoomUser) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(RoomUserTableMap::DATABASE_NAME);
            // primary key is composite; we therefore, expect
            // the primary key passed to be an array of pkey values
            if (count($values) == count($values, COUNT_RECURSIVE)) {
                // array is not multi-dimensional
                $values = array($values);
            }
            foreach ($values as $value) {
                $criterion = $criteria->getNewCriterion(RoomUserTableMap::COL_ROOMUSERID, $value[0]);
                $criterion->addAnd($criteria->getNewCriterion(RoomUserTableMap::COL_REGISTEREDUSERID, $value[1]));
                $criterion->addAnd($criteria->getNewCriterion(RoomUserTableMap::COL_ROOMID, $value[2]));
                $criteria->addOr($criterion);
            }
        }

        $query = RoomUserQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            RoomUserTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                RoomUserTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the RoomUser table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return RoomUserQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a RoomUser or Criteria object.
     *
     * @param mixed               $criteria Criteria or RoomUser object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(RoomUserTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from RoomUser object
        }

        if ($criteria->containsKey(RoomUserTableMap::COL_ROOMUSERID) && $criteria->keyContainsValue(RoomUserTableMap::COL_ROOMUSERID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.RoomUserTableMap::COL_ROOMUSERID.')');
        }


        // Set the correct dbName
        $query = RoomUserQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // RoomUserTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
RoomUserTableMap::buildTableMap();
