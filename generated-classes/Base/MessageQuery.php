<?php

namespace Base;

use \Message as ChildMessage;
use \MessageQuery as ChildMessageQuery;
use \Exception;
use \PDO;
use Map\MessageTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'Message' table.
 *
 *
 *
 * @method     ChildMessageQuery orderByMessageid($order = Criteria::ASC) Order by the MessageId column
 * @method     ChildMessageQuery orderByText($order = Criteria::ASC) Order by the Text column
 * @method     ChildMessageQuery orderByRoomuserid($order = Criteria::ASC) Order by the RoomUserId column
 * @method     ChildMessageQuery orderByRoomid($order = Criteria::ASC) Order by the RoomId column
 * @method     ChildMessageQuery orderByPosttime($order = Criteria::ASC) Order by the PostTime column
 *
 * @method     ChildMessageQuery groupByMessageid() Group by the MessageId column
 * @method     ChildMessageQuery groupByText() Group by the Text column
 * @method     ChildMessageQuery groupByRoomuserid() Group by the RoomUserId column
 * @method     ChildMessageQuery groupByRoomid() Group by the RoomId column
 * @method     ChildMessageQuery groupByPosttime() Group by the PostTime column
 *
 * @method     ChildMessageQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildMessageQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildMessageQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildMessageQuery leftJoinRoom($relationAlias = null) Adds a LEFT JOIN clause to the query using the Room relation
 * @method     ChildMessageQuery rightJoinRoom($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Room relation
 * @method     ChildMessageQuery innerJoinRoom($relationAlias = null) Adds a INNER JOIN clause to the query using the Room relation
 *
 * @method     \RoomQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildMessage findOne(ConnectionInterface $con = null) Return the first ChildMessage matching the query
 * @method     ChildMessage findOneOrCreate(ConnectionInterface $con = null) Return the first ChildMessage matching the query, or a new ChildMessage object populated from the query conditions when no match is found
 *
 * @method     ChildMessage findOneByMessageid(int $MessageId) Return the first ChildMessage filtered by the MessageId column
 * @method     ChildMessage findOneByText(string $Text) Return the first ChildMessage filtered by the Text column
 * @method     ChildMessage findOneByRoomuserid(int $RoomUserId) Return the first ChildMessage filtered by the RoomUserId column
 * @method     ChildMessage findOneByRoomid(int $RoomId) Return the first ChildMessage filtered by the RoomId column
 * @method     ChildMessage findOneByPosttime(string $PostTime) Return the first ChildMessage filtered by the PostTime column
 *
 * @method     ChildMessage[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildMessage objects based on current ModelCriteria
 * @method     ChildMessage[]|ObjectCollection findByMessageid(int $MessageId) Return ChildMessage objects filtered by the MessageId column
 * @method     ChildMessage[]|ObjectCollection findByText(string $Text) Return ChildMessage objects filtered by the Text column
 * @method     ChildMessage[]|ObjectCollection findByRoomuserid(int $RoomUserId) Return ChildMessage objects filtered by the RoomUserId column
 * @method     ChildMessage[]|ObjectCollection findByRoomid(int $RoomId) Return ChildMessage objects filtered by the RoomId column
 * @method     ChildMessage[]|ObjectCollection findByPosttime(string $PostTime) Return ChildMessage objects filtered by the PostTime column
 * @method     ChildMessage[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class MessageQuery extends ModelCriteria
{

    /**
     * Initializes internal state of \Base\MessageQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'chatstorm', $modelName = '\\Message', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildMessageQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildMessageQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildMessageQuery) {
            return $criteria;
        }
        $query = new ChildMessageQuery();
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
     * @return ChildMessage|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = MessageTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(MessageTableMap::DATABASE_NAME);
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
     * @return ChildMessage A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT MessageId, Text, RoomUserId, RoomId, PostTime FROM Message WHERE MessageId = :p0';
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
            /** @var ChildMessage $obj */
            $obj = new ChildMessage();
            $obj->hydrate($row);
            MessageTableMap::addInstanceToPool($obj, (string) $key);
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
     * @return ChildMessage|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildMessageQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(MessageTableMap::COL_MESSAGEID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildMessageQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(MessageTableMap::COL_MESSAGEID, $keys, Criteria::IN);
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
     * @return $this|ChildMessageQuery The current query, for fluid interface
     */
    public function filterByMessageid($messageid = null, $comparison = null)
    {
        if (is_array($messageid)) {
            $useMinMax = false;
            if (isset($messageid['min'])) {
                $this->addUsingAlias(MessageTableMap::COL_MESSAGEID, $messageid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($messageid['max'])) {
                $this->addUsingAlias(MessageTableMap::COL_MESSAGEID, $messageid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(MessageTableMap::COL_MESSAGEID, $messageid, $comparison);
    }

    /**
     * Filter the query on the Text column
     *
     * Example usage:
     * <code>
     * $query->filterByText('fooValue');   // WHERE Text = 'fooValue'
     * $query->filterByText('%fooValue%'); // WHERE Text LIKE '%fooValue%'
     * </code>
     *
     * @param     string $text The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildMessageQuery The current query, for fluid interface
     */
    public function filterByText($text = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($text)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $text)) {
                $text = str_replace('*', '%', $text);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(MessageTableMap::COL_TEXT, $text, $comparison);
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
     * @return $this|ChildMessageQuery The current query, for fluid interface
     */
    public function filterByRoomuserid($roomuserid = null, $comparison = null)
    {
        if (is_array($roomuserid)) {
            $useMinMax = false;
            if (isset($roomuserid['min'])) {
                $this->addUsingAlias(MessageTableMap::COL_ROOMUSERID, $roomuserid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($roomuserid['max'])) {
                $this->addUsingAlias(MessageTableMap::COL_ROOMUSERID, $roomuserid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(MessageTableMap::COL_ROOMUSERID, $roomuserid, $comparison);
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
     * @return $this|ChildMessageQuery The current query, for fluid interface
     */
    public function filterByRoomid($roomid = null, $comparison = null)
    {
        if (is_array($roomid)) {
            $useMinMax = false;
            if (isset($roomid['min'])) {
                $this->addUsingAlias(MessageTableMap::COL_ROOMID, $roomid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($roomid['max'])) {
                $this->addUsingAlias(MessageTableMap::COL_ROOMID, $roomid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(MessageTableMap::COL_ROOMID, $roomid, $comparison);
    }

    /**
     * Filter the query on the PostTime column
     *
     * Example usage:
     * <code>
     * $query->filterByPosttime('2011-03-14'); // WHERE PostTime = '2011-03-14'
     * $query->filterByPosttime('now'); // WHERE PostTime = '2011-03-14'
     * $query->filterByPosttime(array('max' => 'yesterday')); // WHERE PostTime > '2011-03-13'
     * </code>
     *
     * @param     mixed $posttime The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildMessageQuery The current query, for fluid interface
     */
    public function filterByPosttime($posttime = null, $comparison = null)
    {
        if (is_array($posttime)) {
            $useMinMax = false;
            if (isset($posttime['min'])) {
                $this->addUsingAlias(MessageTableMap::COL_POSTTIME, $posttime['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($posttime['max'])) {
                $this->addUsingAlias(MessageTableMap::COL_POSTTIME, $posttime['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(MessageTableMap::COL_POSTTIME, $posttime, $comparison);
    }

    /**
     * Filter the query by a related \Room object
     *
     * @param \Room|ObjectCollection $room The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildMessageQuery The current query, for fluid interface
     */
    public function filterByRoom($room, $comparison = null)
    {
        if ($room instanceof \Room) {
            return $this
                ->addUsingAlias(MessageTableMap::COL_ROOMID, $room->getRoomid(), $comparison);
        } elseif ($room instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(MessageTableMap::COL_ROOMID, $room->toKeyValue('Roomid', 'Roomid'), $comparison);
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
     * @return $this|ChildMessageQuery The current query, for fluid interface
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
     * @param   ChildMessage $message Object to remove from the list of results
     *
     * @return $this|ChildMessageQuery The current query, for fluid interface
     */
    public function prune($message = null)
    {
        if ($message) {
            $this->addUsingAlias(MessageTableMap::COL_MESSAGEID, $message->getMessageid(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the Message table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(MessageTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            MessageTableMap::clearInstancePool();
            MessageTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(MessageTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(MessageTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            MessageTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            MessageTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // MessageQuery
