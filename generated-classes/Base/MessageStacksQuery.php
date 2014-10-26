<?php

namespace Base;

use \MessageStacks as ChildMessageStacks;
use \MessageStacksQuery as ChildMessageStacksQuery;
use \Exception;
use \PDO;
use Map\MessageStacksTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'MessageStacks' table.
 *
 *
 *
 * @method     ChildMessageStacksQuery orderByMessagestackid($order = Criteria::ASC) Order by the MessageStackId column
 * @method     ChildMessageStacksQuery orderByRoomid($order = Criteria::ASC) Order by the RoomId column
 * @method     ChildMessageStacksQuery orderByMessageid($order = Criteria::ASC) Order by the MessageId column
 *
 * @method     ChildMessageStacksQuery groupByMessagestackid() Group by the MessageStackId column
 * @method     ChildMessageStacksQuery groupByRoomid() Group by the RoomId column
 * @method     ChildMessageStacksQuery groupByMessageid() Group by the MessageId column
 *
 * @method     ChildMessageStacksQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildMessageStacksQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildMessageStacksQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildMessageStacks findOne(ConnectionInterface $con = null) Return the first ChildMessageStacks matching the query
 * @method     ChildMessageStacks findOneOrCreate(ConnectionInterface $con = null) Return the first ChildMessageStacks matching the query, or a new ChildMessageStacks object populated from the query conditions when no match is found
 *
 * @method     ChildMessageStacks findOneByMessagestackid(int $MessageStackId) Return the first ChildMessageStacks filtered by the MessageStackId column
 * @method     ChildMessageStacks findOneByRoomid(int $RoomId) Return the first ChildMessageStacks filtered by the RoomId column
 * @method     ChildMessageStacks findOneByMessageid(int $MessageId) Return the first ChildMessageStacks filtered by the MessageId column
 *
 * @method     ChildMessageStacks[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildMessageStacks objects based on current ModelCriteria
 * @method     ChildMessageStacks[]|ObjectCollection findByMessagestackid(int $MessageStackId) Return ChildMessageStacks objects filtered by the MessageStackId column
 * @method     ChildMessageStacks[]|ObjectCollection findByRoomid(int $RoomId) Return ChildMessageStacks objects filtered by the RoomId column
 * @method     ChildMessageStacks[]|ObjectCollection findByMessageid(int $MessageId) Return ChildMessageStacks objects filtered by the MessageId column
 * @method     ChildMessageStacks[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class MessageStacksQuery extends ModelCriteria
{

    /**
     * Initializes internal state of \Base\MessageStacksQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'chatstorm', $modelName = '\\MessageStacks', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildMessageStacksQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildMessageStacksQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildMessageStacksQuery) {
            return $criteria;
        }
        $query = new ChildMessageStacksQuery();
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
     * @return ChildMessageStacks|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = MessageStacksTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(MessageStacksTableMap::DATABASE_NAME);
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
     * @return ChildMessageStacks A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT MessageStackId, RoomId, MessageId FROM MessageStacks WHERE MessageStackId = :p0';
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
            /** @var ChildMessageStacks $obj */
            $obj = new ChildMessageStacks();
            $obj->hydrate($row);
            MessageStacksTableMap::addInstanceToPool($obj, (string) $key);
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
     * @return ChildMessageStacks|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildMessageStacksQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(MessageStacksTableMap::COL_MESSAGESTACKID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildMessageStacksQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(MessageStacksTableMap::COL_MESSAGESTACKID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the MessageStackId column
     *
     * Example usage:
     * <code>
     * $query->filterByMessagestackid(1234); // WHERE MessageStackId = 1234
     * $query->filterByMessagestackid(array(12, 34)); // WHERE MessageStackId IN (12, 34)
     * $query->filterByMessagestackid(array('min' => 12)); // WHERE MessageStackId > 12
     * </code>
     *
     * @param     mixed $messagestackid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildMessageStacksQuery The current query, for fluid interface
     */
    public function filterByMessagestackid($messagestackid = null, $comparison = null)
    {
        if (is_array($messagestackid)) {
            $useMinMax = false;
            if (isset($messagestackid['min'])) {
                $this->addUsingAlias(MessageStacksTableMap::COL_MESSAGESTACKID, $messagestackid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($messagestackid['max'])) {
                $this->addUsingAlias(MessageStacksTableMap::COL_MESSAGESTACKID, $messagestackid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(MessageStacksTableMap::COL_MESSAGESTACKID, $messagestackid, $comparison);
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
     * @return $this|ChildMessageStacksQuery The current query, for fluid interface
     */
    public function filterByRoomid($roomid = null, $comparison = null)
    {
        if (is_array($roomid)) {
            $useMinMax = false;
            if (isset($roomid['min'])) {
                $this->addUsingAlias(MessageStacksTableMap::COL_ROOMID, $roomid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($roomid['max'])) {
                $this->addUsingAlias(MessageStacksTableMap::COL_ROOMID, $roomid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(MessageStacksTableMap::COL_ROOMID, $roomid, $comparison);
    }

    /**
     * Filter the query on the MessageId column
     *
     * Example usage:
     * <code>
     * $query->filterByMessageid(1234); // WHERE MessageId = 1234
     * $query->filterByMessageid(array(12, 34)); // WHERE MessageId IN (12, 34)
     * $query->filterByMessageid(array('min' => 12)); // WHERE MessageId > 12
     * </code>
     *
     * @param     mixed $messageid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildMessageStacksQuery The current query, for fluid interface
     */
    public function filterByMessageid($messageid = null, $comparison = null)
    {
        if (is_array($messageid)) {
            $useMinMax = false;
            if (isset($messageid['min'])) {
                $this->addUsingAlias(MessageStacksTableMap::COL_MESSAGEID, $messageid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($messageid['max'])) {
                $this->addUsingAlias(MessageStacksTableMap::COL_MESSAGEID, $messageid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(MessageStacksTableMap::COL_MESSAGEID, $messageid, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   ChildMessageStacks $messageStacks Object to remove from the list of results
     *
     * @return $this|ChildMessageStacksQuery The current query, for fluid interface
     */
    public function prune($messageStacks = null)
    {
        if ($messageStacks) {
            $this->addUsingAlias(MessageStacksTableMap::COL_MESSAGESTACKID, $messageStacks->getMessagestackid(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the MessageStacks table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(MessageStacksTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            MessageStacksTableMap::clearInstancePool();
            MessageStacksTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(MessageStacksTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(MessageStacksTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            MessageStacksTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            MessageStacksTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // MessageStacksQuery
