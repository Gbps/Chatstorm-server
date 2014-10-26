<?php

namespace Base;

use \RoomUsers as ChildRoomUsers;
use \RoomUsersQuery as ChildRoomUsersQuery;
use \Exception;
use \PDO;
use Map\RoomUsersTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'RoomUsers' table.
 *
 *
 *
 * @method     ChildRoomUsersQuery orderByRoomusersid($order = Criteria::ASC) Order by the RoomUsersId column
 * @method     ChildRoomUsersQuery orderByRoomuserid($order = Criteria::ASC) Order by the RoomUserId column
 * @method     ChildRoomUsersQuery orderByRoomid($order = Criteria::ASC) Order by the RoomId column
 *
 * @method     ChildRoomUsersQuery groupByRoomusersid() Group by the RoomUsersId column
 * @method     ChildRoomUsersQuery groupByRoomuserid() Group by the RoomUserId column
 * @method     ChildRoomUsersQuery groupByRoomid() Group by the RoomId column
 *
 * @method     ChildRoomUsersQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildRoomUsersQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildRoomUsersQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildRoomUsers findOne(ConnectionInterface $con = null) Return the first ChildRoomUsers matching the query
 * @method     ChildRoomUsers findOneOrCreate(ConnectionInterface $con = null) Return the first ChildRoomUsers matching the query, or a new ChildRoomUsers object populated from the query conditions when no match is found
 *
 * @method     ChildRoomUsers findOneByRoomusersid(int $RoomUsersId) Return the first ChildRoomUsers filtered by the RoomUsersId column
 * @method     ChildRoomUsers findOneByRoomuserid(int $RoomUserId) Return the first ChildRoomUsers filtered by the RoomUserId column
 * @method     ChildRoomUsers findOneByRoomid(int $RoomId) Return the first ChildRoomUsers filtered by the RoomId column
 *
 * @method     ChildRoomUsers[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildRoomUsers objects based on current ModelCriteria
 * @method     ChildRoomUsers[]|ObjectCollection findByRoomusersid(int $RoomUsersId) Return ChildRoomUsers objects filtered by the RoomUsersId column
 * @method     ChildRoomUsers[]|ObjectCollection findByRoomuserid(int $RoomUserId) Return ChildRoomUsers objects filtered by the RoomUserId column
 * @method     ChildRoomUsers[]|ObjectCollection findByRoomid(int $RoomId) Return ChildRoomUsers objects filtered by the RoomId column
 * @method     ChildRoomUsers[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class RoomUsersQuery extends ModelCriteria
{

    /**
     * Initializes internal state of \Base\RoomUsersQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'chatstorm', $modelName = '\\RoomUsers', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildRoomUsersQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildRoomUsersQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildRoomUsersQuery) {
            return $criteria;
        }
        $query = new ChildRoomUsersQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildRoomUsers|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = RoomUsersTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(RoomUsersTableMap::DATABASE_NAME);
        }
        $this->basePreSelect($con);
        if ($this->formatter || $this->modelAlias || $this->with || $this->select
         || $this->selectColumns || $this->asColumns || $this->selectModifiers
         || $this->map || $this->having || $this->joins) {
            return $this->findPkComplex($key, $con);
        } else {
            return $this->findPkSimple($key, $con);
        }
    }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildRoomUsers A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT RoomUsersId, RoomUserId, RoomId FROM RoomUsers WHERE RoomUsersId = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildRoomUsers $obj */
            $obj = new ChildRoomUsers();
            $obj->hydrate($row);
            RoomUsersTableMap::addInstanceToPool($obj, (string) $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @return ChildRoomUsers|array|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, ConnectionInterface $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($dataFetcher);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     ConnectionInterface $con an optional connection object
     *
     * @return ObjectCollection|array|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getReadConnection($this->getDbName());
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($dataFetcher);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return $this|ChildRoomUsersQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(RoomUsersTableMap::COL_ROOMUSERSID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildRoomUsersQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(RoomUsersTableMap::COL_ROOMUSERSID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the RoomUsersId column
     *
     * Example usage:
     * <code>
     * $query->filterByRoomusersid(1234); // WHERE RoomUsersId = 1234
     * $query->filterByRoomusersid(array(12, 34)); // WHERE RoomUsersId IN (12, 34)
     * $query->filterByRoomusersid(array('min' => 12)); // WHERE RoomUsersId > 12
     * </code>
     *
     * @param     mixed $roomusersid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildRoomUsersQuery The current query, for fluid interface
     */
    public function filterByRoomusersid($roomusersid = null, $comparison = null)
    {
        if (is_array($roomusersid)) {
            $useMinMax = false;
            if (isset($roomusersid['min'])) {
                $this->addUsingAlias(RoomUsersTableMap::COL_ROOMUSERSID, $roomusersid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($roomusersid['max'])) {
                $this->addUsingAlias(RoomUsersTableMap::COL_ROOMUSERSID, $roomusersid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RoomUsersTableMap::COL_ROOMUSERSID, $roomusersid, $comparison);
    }

    /**
     * Filter the query on the RoomUserId column
     *
     * Example usage:
     * <code>
     * $query->filterByRoomuserid(1234); // WHERE RoomUserId = 1234
     * $query->filterByRoomuserid(array(12, 34)); // WHERE RoomUserId IN (12, 34)
     * $query->filterByRoomuserid(array('min' => 12)); // WHERE RoomUserId > 12
     * </code>
     *
     * @param     mixed $roomuserid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildRoomUsersQuery The current query, for fluid interface
     */
    public function filterByRoomuserid($roomuserid = null, $comparison = null)
    {
        if (is_array($roomuserid)) {
            $useMinMax = false;
            if (isset($roomuserid['min'])) {
                $this->addUsingAlias(RoomUsersTableMap::COL_ROOMUSERID, $roomuserid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($roomuserid['max'])) {
                $this->addUsingAlias(RoomUsersTableMap::COL_ROOMUSERID, $roomuserid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RoomUsersTableMap::COL_ROOMUSERID, $roomuserid, $comparison);
    }

    /**
     * Filter the query on the RoomId column
     *
     * Example usage:
     * <code>
     * $query->filterByRoomid(1234); // WHERE RoomId = 1234
     * $query->filterByRoomid(array(12, 34)); // WHERE RoomId IN (12, 34)
     * $query->filterByRoomid(array('min' => 12)); // WHERE RoomId > 12
     * </code>
     *
     * @param     mixed $roomid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildRoomUsersQuery The current query, for fluid interface
     */
    public function filterByRoomid($roomid = null, $comparison = null)
    {
        if (is_array($roomid)) {
            $useMinMax = false;
            if (isset($roomid['min'])) {
                $this->addUsingAlias(RoomUsersTableMap::COL_ROOMID, $roomid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($roomid['max'])) {
                $this->addUsingAlias(RoomUsersTableMap::COL_ROOMID, $roomid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RoomUsersTableMap::COL_ROOMID, $roomid, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   ChildRoomUsers $roomUsers Object to remove from the list of results
     *
     * @return $this|ChildRoomUsersQuery The current query, for fluid interface
     */
    public function prune($roomUsers = null)
    {
        if ($roomUsers) {
            $this->addUsingAlias(RoomUsersTableMap::COL_ROOMUSERSID, $roomUsers->getRoomusersid(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the RoomUsers table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(RoomUsersTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            RoomUsersTableMap::clearInstancePool();
            RoomUsersTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    /**
     * Performs a DELETE on the database based on the current ModelCriteria
     *
     * @param ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public function delete(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(RoomUsersTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(RoomUsersTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            RoomUsersTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            RoomUsersTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // RoomUsersQuery
