<?php

namespace Base;

use \RoomUser as ChildRoomUser;
use \RoomUserQuery as ChildRoomUserQuery;
use \Exception;
use \PDO;
use Map\RoomUserTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'RoomUser' table.
 *
 *
 *
 * @method     ChildRoomUserQuery orderByRoomuserid($order = Criteria::ASC) Order by the RoomUserId column
 * @method     ChildRoomUserQuery orderByVisiblename($order = Criteria::ASC) Order by the VisibleName column
 * @method     ChildRoomUserQuery orderByRegistereduserid($order = Criteria::ASC) Order by the RegisteredUserId column
 * @method     ChildRoomUserQuery orderByHasvoted($order = Criteria::ASC) Order by the HasVoted column
 * @method     ChildRoomUserQuery orderByRoomid($order = Criteria::ASC) Order by the RoomId column
 *
 * @method     ChildRoomUserQuery groupByRoomuserid() Group by the RoomUserId column
 * @method     ChildRoomUserQuery groupByVisiblename() Group by the VisibleName column
 * @method     ChildRoomUserQuery groupByRegistereduserid() Group by the RegisteredUserId column
 * @method     ChildRoomUserQuery groupByHasvoted() Group by the HasVoted column
 * @method     ChildRoomUserQuery groupByRoomid() Group by the RoomId column
 *
 * @method     ChildRoomUserQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildRoomUserQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildRoomUserQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildRoomUserQuery leftJoinRegisteredUser($relationAlias = null) Adds a LEFT JOIN clause to the query using the RegisteredUser relation
 * @method     ChildRoomUserQuery rightJoinRegisteredUser($relationAlias = null) Adds a RIGHT JOIN clause to the query using the RegisteredUser relation
 * @method     ChildRoomUserQuery innerJoinRegisteredUser($relationAlias = null) Adds a INNER JOIN clause to the query using the RegisteredUser relation
 *
 * @method     ChildRoomUserQuery leftJoinRoom($relationAlias = null) Adds a LEFT JOIN clause to the query using the Room relation
 * @method     ChildRoomUserQuery rightJoinRoom($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Room relation
 * @method     ChildRoomUserQuery innerJoinRoom($relationAlias = null) Adds a INNER JOIN clause to the query using the Room relation
 *
 * @method     \RegisteredUserQuery|\RoomQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildRoomUser findOne(ConnectionInterface $con = null) Return the first ChildRoomUser matching the query
 * @method     ChildRoomUser findOneOrCreate(ConnectionInterface $con = null) Return the first ChildRoomUser matching the query, or a new ChildRoomUser object populated from the query conditions when no match is found
 *
 * @method     ChildRoomUser findOneByRoomuserid(int $RoomUserId) Return the first ChildRoomUser filtered by the RoomUserId column
 * @method     ChildRoomUser findOneByVisiblename(string $VisibleName) Return the first ChildRoomUser filtered by the VisibleName column
 * @method     ChildRoomUser findOneByRegistereduserid(int $RegisteredUserId) Return the first ChildRoomUser filtered by the RegisteredUserId column
 * @method     ChildRoomUser findOneByHasvoted(boolean $HasVoted) Return the first ChildRoomUser filtered by the HasVoted column
 * @method     ChildRoomUser findOneByRoomid(int $RoomId) Return the first ChildRoomUser filtered by the RoomId column
 *
 * @method     ChildRoomUser[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildRoomUser objects based on current ModelCriteria
 * @method     ChildRoomUser[]|ObjectCollection findByRoomuserid(int $RoomUserId) Return ChildRoomUser objects filtered by the RoomUserId column
 * @method     ChildRoomUser[]|ObjectCollection findByVisiblename(string $VisibleName) Return ChildRoomUser objects filtered by the VisibleName column
 * @method     ChildRoomUser[]|ObjectCollection findByRegistereduserid(int $RegisteredUserId) Return ChildRoomUser objects filtered by the RegisteredUserId column
 * @method     ChildRoomUser[]|ObjectCollection findByHasvoted(boolean $HasVoted) Return ChildRoomUser objects filtered by the HasVoted column
 * @method     ChildRoomUser[]|ObjectCollection findByRoomid(int $RoomId) Return ChildRoomUser objects filtered by the RoomId column
 * @method     ChildRoomUser[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class RoomUserQuery extends ModelCriteria
{

    /**
     * Initializes internal state of \Base\RoomUserQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'chatstorm', $modelName = '\\RoomUser', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildRoomUserQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildRoomUserQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildRoomUserQuery) {
            return $criteria;
        }
        $query = new ChildRoomUserQuery();
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
     * $obj = $c->findPk(array(12, 34, 56), $con);
     * </code>
     *
     * @param array[$RoomUserId, $RegisteredUserId, $RoomId] $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildRoomUser|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = RoomUserTableMap::getInstanceFromPool(serialize(array((string) $key[0], (string) $key[1], (string) $key[2]))))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(RoomUserTableMap::DATABASE_NAME);
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
     * @return ChildRoomUser A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT RoomUserId, VisibleName, RegisteredUserId, HasVoted, RoomId FROM RoomUser WHERE RoomUserId = :p0 AND RegisteredUserId = :p1 AND RoomId = :p2';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key[0], PDO::PARAM_INT);
            $stmt->bindValue(':p1', $key[1], PDO::PARAM_INT);
            $stmt->bindValue(':p2', $key[2], PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildRoomUser $obj */
            $obj = new ChildRoomUser();
            $obj->hydrate($row);
            RoomUserTableMap::addInstanceToPool($obj, serialize(array((string) $key[0], (string) $key[1], (string) $key[2])));
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
     * @return ChildRoomUser|array|mixed the result, formatted by the current formatter
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
     * $objs = $c->findPks(array(array(12, 56), array(832, 123), array(123, 456)), $con);
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
     * @return $this|ChildRoomUserQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(RoomUserTableMap::COL_ROOMUSERID, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(RoomUserTableMap::COL_REGISTEREDUSERID, $key[1], Criteria::EQUAL);
        $this->addUsingAlias(RoomUserTableMap::COL_ROOMID, $key[2], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildRoomUserQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(RoomUserTableMap::COL_ROOMUSERID, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(RoomUserTableMap::COL_REGISTEREDUSERID, $key[1], Criteria::EQUAL);
            $cton0->addAnd($cton1);
            $cton2 = $this->getNewCriterion(RoomUserTableMap::COL_ROOMID, $key[2], Criteria::EQUAL);
            $cton0->addAnd($cton2);
            $this->addOr($cton0);
        }

        return $this;
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
     * @return $this|ChildRoomUserQuery The current query, for fluid interface
     */
    public function filterByRoomuserid($roomuserid = null, $comparison = null)
    {
        if (is_array($roomuserid)) {
            $useMinMax = false;
            if (isset($roomuserid['min'])) {
                $this->addUsingAlias(RoomUserTableMap::COL_ROOMUSERID, $roomuserid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($roomuserid['max'])) {
                $this->addUsingAlias(RoomUserTableMap::COL_ROOMUSERID, $roomuserid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RoomUserTableMap::COL_ROOMUSERID, $roomuserid, $comparison);
    }

    /**
     * Filter the query on the VisibleName column
     *
     * Example usage:
     * <code>
     * $query->filterByVisiblename('fooValue');   // WHERE VisibleName = 'fooValue'
     * $query->filterByVisiblename('%fooValue%'); // WHERE VisibleName LIKE '%fooValue%'
     * </code>
     *
     * @param     string $visiblename The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildRoomUserQuery The current query, for fluid interface
     */
    public function filterByVisiblename($visiblename = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($visiblename)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $visiblename)) {
                $visiblename = str_replace('*', '%', $visiblename);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(RoomUserTableMap::COL_VISIBLENAME, $visiblename, $comparison);
    }

    /**
     * Filter the query on the RegisteredUserId column
     *
     * Example usage:
     * <code>
     * $query->filterByRegistereduserid(1234); // WHERE RegisteredUserId = 1234
     * $query->filterByRegistereduserid(array(12, 34)); // WHERE RegisteredUserId IN (12, 34)
     * $query->filterByRegistereduserid(array('min' => 12)); // WHERE RegisteredUserId > 12
     * </code>
     *
     * @see       filterByRegisteredUser()
     *
     * @param     mixed $registereduserid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildRoomUserQuery The current query, for fluid interface
     */
    public function filterByRegistereduserid($registereduserid = null, $comparison = null)
    {
        if (is_array($registereduserid)) {
            $useMinMax = false;
            if (isset($registereduserid['min'])) {
                $this->addUsingAlias(RoomUserTableMap::COL_REGISTEREDUSERID, $registereduserid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($registereduserid['max'])) {
                $this->addUsingAlias(RoomUserTableMap::COL_REGISTEREDUSERID, $registereduserid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RoomUserTableMap::COL_REGISTEREDUSERID, $registereduserid, $comparison);
    }

    /**
     * Filter the query on the HasVoted column
     *
     * Example usage:
     * <code>
     * $query->filterByHasvoted(true); // WHERE HasVoted = true
     * $query->filterByHasvoted('yes'); // WHERE HasVoted = true
     * </code>
     *
     * @param     boolean|string $hasvoted The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildRoomUserQuery The current query, for fluid interface
     */
    public function filterByHasvoted($hasvoted = null, $comparison = null)
    {
        if (is_string($hasvoted)) {
            $hasvoted = in_array(strtolower($hasvoted), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(RoomUserTableMap::COL_HASVOTED, $hasvoted, $comparison);
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
     * @return $this|ChildRoomUserQuery The current query, for fluid interface
     */
    public function filterByRoomid($roomid = null, $comparison = null)
    {
        if (is_array($roomid)) {
            $useMinMax = false;
            if (isset($roomid['min'])) {
                $this->addUsingAlias(RoomUserTableMap::COL_ROOMID, $roomid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($roomid['max'])) {
                $this->addUsingAlias(RoomUserTableMap::COL_ROOMID, $roomid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RoomUserTableMap::COL_ROOMID, $roomid, $comparison);
    }

    /**
     * Filter the query by a related \RegisteredUser object
     *
     * @param \RegisteredUser|ObjectCollection $registeredUser The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildRoomUserQuery The current query, for fluid interface
     */
    public function filterByRegisteredUser($registeredUser, $comparison = null)
    {
        if ($registeredUser instanceof \RegisteredUser) {
            return $this
                ->addUsingAlias(RoomUserTableMap::COL_REGISTEREDUSERID, $registeredUser->getRegistereduserid(), $comparison);
        } elseif ($registeredUser instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(RoomUserTableMap::COL_REGISTEREDUSERID, $registeredUser->toKeyValue('PrimaryKey', 'Registereduserid'), $comparison);
        } else {
            throw new PropelException('filterByRegisteredUser() only accepts arguments of type \RegisteredUser or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the RegisteredUser relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildRoomUserQuery The current query, for fluid interface
     */
    public function joinRegisteredUser($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('RegisteredUser');

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
            $this->addJoinObject($join, 'RegisteredUser');
        }

        return $this;
    }

    /**
     * Use the RegisteredUser relation RegisteredUser object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \RegisteredUserQuery A secondary query class using the current class as primary query
     */
    public function useRegisteredUserQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinRegisteredUser($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'RegisteredUser', '\RegisteredUserQuery');
    }

    /**
     * Filter the query by a related \Room object
     *
     * @param \Room|ObjectCollection $room The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildRoomUserQuery The current query, for fluid interface
     */
    public function filterByRoom($room, $comparison = null)
    {
        if ($room instanceof \Room) {
            return $this
                ->addUsingAlias(RoomUserTableMap::COL_ROOMID, $room->getRoomid(), $comparison);
        } elseif ($room instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(RoomUserTableMap::COL_ROOMID, $room->toKeyValue('Roomid', 'Roomid'), $comparison);
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
     * @return $this|ChildRoomUserQuery The current query, for fluid interface
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
     * @param   ChildRoomUser $roomUser Object to remove from the list of results
     *
     * @return $this|ChildRoomUserQuery The current query, for fluid interface
     */
    public function prune($roomUser = null)
    {
        if ($roomUser) {
            $this->addCond('pruneCond0', $this->getAliasedColName(RoomUserTableMap::COL_ROOMUSERID), $roomUser->getRoomuserid(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(RoomUserTableMap::COL_REGISTEREDUSERID), $roomUser->getRegistereduserid(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond2', $this->getAliasedColName(RoomUserTableMap::COL_ROOMID), $roomUser->getRoomid(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1', 'pruneCond2'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

    /**
     * Deletes all rows from the RoomUser table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(RoomUserTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            RoomUserTableMap::clearInstancePool();
            RoomUserTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(RoomUserTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(RoomUserTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            RoomUserTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            RoomUserTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // RoomUserQuery
