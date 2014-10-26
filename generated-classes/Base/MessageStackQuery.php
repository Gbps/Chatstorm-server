<?php

namespace Base;

use \MessageStack as ChildMessageStack;
use \MessageStackQuery as ChildMessageStackQuery;
use \Exception;
use \PDO;
use Map\MessageStackTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'MessageStack' table.
 *
 *
 *
 * @method     ChildMessageStackQuery orderByMessagestackid($order = Criteria::ASC) Order by the MessageStackId column
 * @method     ChildMessageStackQuery orderByMessageid($order = Criteria::ASC) Order by the MessageId column
 * @method     ChildMessageStackQuery orderByRoomid($order = Criteria::ASC) Order by the RoomId column
 *
 * @method     ChildMessageStackQuery groupByMessagestackid() Group by the MessageStackId column
 * @method     ChildMessageStackQuery groupByMessageid() Group by the MessageId column
 * @method     ChildMessageStackQuery groupByRoomid() Group by the RoomId column
 *
 * @method     ChildMessageStackQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildMessageStackQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildMessageStackQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildMessageStackQuery leftJoinMessage($relationAlias = null) Adds a LEFT JOIN clause to the query using the Message relation
 * @method     ChildMessageStackQuery rightJoinMessage($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Message relation
 * @method     ChildMessageStackQuery innerJoinMessage($relationAlias = null) Adds a INNER JOIN clause to the query using the Message relation
 *
 * @method     ChildMessageStackQuery leftJoinRoom($relationAlias = null) Adds a LEFT JOIN clause to the query using the Room relation
 * @method     ChildMessageStackQuery rightJoinRoom($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Room relation
 * @method     ChildMessageStackQuery innerJoinRoom($relationAlias = null) Adds a INNER JOIN clause to the query using the Room relation
 *
 * @method     \MessageQuery|\RoomQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildMessageStack findOne(ConnectionInterface $con = null) Return the first ChildMessageStack matching the query
 * @method     ChildMessageStack findOneOrCreate(ConnectionInterface $con = null) Return the first ChildMessageStack matching the query, or a new ChildMessageStack object populated from the query conditions when no match is found
 *
 * @method     ChildMessageStack findOneByMessagestackid(int $MessageStackId) Return the first ChildMessageStack filtered by the MessageStackId column
 * @method     ChildMessageStack findOneByMessageid(int $MessageId) Return the first ChildMessageStack filtered by the MessageId column
 * @method     ChildMessageStack findOneByRoomid(int $RoomId) Return the first ChildMessageStack filtered by the RoomId column
 *
 * @method     ChildMessageStack[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildMessageStack objects based on current ModelCriteria
 * @method     ChildMessageStack[]|ObjectCollection findByMessagestackid(int $MessageStackId) Return ChildMessageStack objects filtered by the MessageStackId column
 * @method     ChildMessageStack[]|ObjectCollection findByMessageid(int $MessageId) Return ChildMessageStack objects filtered by the MessageId column
 * @method     ChildMessageStack[]|ObjectCollection findByRoomid(int $RoomId) Return ChildMessageStack objects filtered by the RoomId column
 * @method     ChildMessageStack[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class MessageStackQuery extends ModelCriteria
{

    /**
     * Initializes internal state of \Base\MessageStackQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'chatstorm', $modelName = '\\MessageStack', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildMessageStackQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildMessageStackQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildMessageStackQuery) {
            return $criteria;
        }
        $query = new ChildMessageStackQuery();
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
     * @return ChildMessageStack|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = MessageStackTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(MessageStackTableMap::DATABASE_NAME);
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
     * @return ChildMessageStack A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT MessageStackId, MessageId, RoomId FROM MessageStack WHERE MessageStackId = :p0';
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
            /** @var ChildMessageStack $obj */
            $obj = new ChildMessageStack();
            $obj->hydrate($row);
            MessageStackTableMap::addInstanceToPool($obj, (string) $key);
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
     * @return ChildMessageStack|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildMessageStackQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(MessageStackTableMap::COL_MESSAGESTACKID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildMessageStackQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(MessageStackTableMap::COL_MESSAGESTACKID, $keys, Criteria::IN);
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
     * @return $this|ChildMessageStackQuery The current query, for fluid interface
     */
    public function filterByMessagestackid($messagestackid = null, $comparison = null)
    {
        if (is_array($messagestackid)) {
            $useMinMax = false;
            if (isset($messagestackid['min'])) {
                $this->addUsingAlias(MessageStackTableMap::COL_MESSAGESTACKID, $messagestackid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($messagestackid['max'])) {
                $this->addUsingAlias(MessageStackTableMap::COL_MESSAGESTACKID, $messagestackid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(MessageStackTableMap::COL_MESSAGESTACKID, $messagestackid, $comparison);
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
     * @see       filterByMessage()
     *
     * @param     mixed $messageid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildMessageStackQuery The current query, for fluid interface
     */
    public function filterByMessageid($messageid = null, $comparison = null)
    {
        if (is_array($messageid)) {
            $useMinMax = false;
            if (isset($messageid['min'])) {
                $this->addUsingAlias(MessageStackTableMap::COL_MESSAGEID, $messageid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($messageid['max'])) {
                $this->addUsingAlias(MessageStackTableMap::COL_MESSAGEID, $messageid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(MessageStackTableMap::COL_MESSAGEID, $messageid, $comparison);
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
     * @see       filterByRoom()
     *
     * @param     mixed $roomid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildMessageStackQuery The current query, for fluid interface
     */
    public function filterByRoomid($roomid = null, $comparison = null)
    {
        if (is_array($roomid)) {
            $useMinMax = false;
            if (isset($roomid['min'])) {
                $this->addUsingAlias(MessageStackTableMap::COL_ROOMID, $roomid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($roomid['max'])) {
                $this->addUsingAlias(MessageStackTableMap::COL_ROOMID, $roomid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(MessageStackTableMap::COL_ROOMID, $roomid, $comparison);
    }

    /**
     * Filter the query by a related \Message object
     *
     * @param \Message|ObjectCollection $message The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildMessageStackQuery The current query, for fluid interface
     */
    public function filterByMessage($message, $comparison = null)
    {
        if ($message instanceof \Message) {
            return $this
                ->addUsingAlias(MessageStackTableMap::COL_MESSAGEID, $message->getMessageid(), $comparison);
        } elseif ($message instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(MessageStackTableMap::COL_MESSAGEID, $message->toKeyValue('PrimaryKey', 'Messageid'), $comparison);
        } else {
            throw new PropelException('filterByMessage() only accepts arguments of type \Message or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Message relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildMessageStackQuery The current query, for fluid interface
     */
    public function joinMessage($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Message');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Message');
        }

        return $this;
    }

    /**
     * Use the Message relation Message object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \MessageQuery A secondary query class using the current class as primary query
     */
    public function useMessageQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinMessage($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Message', '\MessageQuery');
    }

    /**
     * Filter the query by a related \Room object
     *
     * @param \Room|ObjectCollection $room The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildMessageStackQuery The current query, for fluid interface
     */
    public function filterByRoom($room, $comparison = null)
    {
        if ($room instanceof \Room) {
            return $this
                ->addUsingAlias(MessageStackTableMap::COL_ROOMID, $room->getRoomid(), $comparison);
        } elseif ($room instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(MessageStackTableMap::COL_ROOMID, $room->toKeyValue('PrimaryKey', 'Roomid'), $comparison);
        } else {
            throw new PropelException('filterByRoom() only accepts arguments of type \Room or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Room relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildMessageStackQuery The current query, for fluid interface
     */
    public function joinRoom($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Room');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Room');
        }

        return $this;
    }

    /**
     * Use the Room relation Room object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \RoomQuery A secondary query class using the current class as primary query
     */
    public function useRoomQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinRoom($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Room', '\RoomQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildMessageStack $messageStack Object to remove from the list of results
     *
     * @return $this|ChildMessageStackQuery The current query, for fluid interface
     */
    public function prune($messageStack = null)
    {
        if ($messageStack) {
            $this->addUsingAlias(MessageStackTableMap::COL_MESSAGESTACKID, $messageStack->getMessagestackid(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the MessageStack table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(MessageStackTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            MessageStackTableMap::clearInstancePool();
            MessageStackTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(MessageStackTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(MessageStackTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            MessageStackTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            MessageStackTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // MessageStackQuery
