<?php

namespace Base;

use \Room as ChildRoom;
use \RoomQuery as ChildRoomQuery;
use \Exception;
use \PDO;
use Map\RoomTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'Room' table.
 *
 *
 *
 * @method     ChildRoomQuery orderByRoomid($order = Criteria::ASC) Order by the RoomId column
 * @method     ChildRoomQuery orderByCreateddate($order = Criteria::ASC) Order by the CreatedDate column
 * @method     ChildRoomQuery orderByCreatoruserid($order = Criteria::ASC) Order by the CreatorUserId column
 * @method     ChildRoomQuery orderByTopic($order = Criteria::ASC) Order by the Topic column
 * @method     ChildRoomQuery orderByTimeout($order = Criteria::ASC) Order by the Timeout column
 * @method     ChildRoomQuery orderByRating($order = Criteria::ASC) Order by the Rating column
 * @method     ChildRoomQuery orderByLocationlatitude($order = Criteria::ASC) Order by the LocationLatitude column
 * @method     ChildRoomQuery orderByLocationlongitude($order = Criteria::ASC) Order by the LocationLongitude column
 * @method     ChildRoomQuery orderByLocationaccuracy($order = Criteria::ASC) Order by the LocationAccuracy column
 *
 * @method     ChildRoomQuery groupByRoomid() Group by the RoomId column
 * @method     ChildRoomQuery groupByCreateddate() Group by the CreatedDate column
 * @method     ChildRoomQuery groupByCreatoruserid() Group by the CreatorUserId column
 * @method     ChildRoomQuery groupByTopic() Group by the Topic column
 * @method     ChildRoomQuery groupByTimeout() Group by the Timeout column
 * @method     ChildRoomQuery groupByRating() Group by the Rating column
 * @method     ChildRoomQuery groupByLocationlatitude() Group by the LocationLatitude column
 * @method     ChildRoomQuery groupByLocationlongitude() Group by the LocationLongitude column
 * @method     ChildRoomQuery groupByLocationaccuracy() Group by the LocationAccuracy column
 *
 * @method     ChildRoomQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildRoomQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildRoomQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildRoomQuery leftJoinCreator($relationAlias = null) Adds a LEFT JOIN clause to the query using the Creator relation
 * @method     ChildRoomQuery rightJoinCreator($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Creator relation
 * @method     ChildRoomQuery innerJoinCreator($relationAlias = null) Adds a INNER JOIN clause to the query using the Creator relation
 *
 * @method     ChildRoomQuery leftJoinMessage($relationAlias = null) Adds a LEFT JOIN clause to the query using the Message relation
 * @method     ChildRoomQuery rightJoinMessage($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Message relation
 * @method     ChildRoomQuery innerJoinMessage($relationAlias = null) Adds a INNER JOIN clause to the query using the Message relation
 *
 * @method     ChildRoomQuery leftJoinRoomUser($relationAlias = null) Adds a LEFT JOIN clause to the query using the RoomUser relation
 * @method     ChildRoomQuery rightJoinRoomUser($relationAlias = null) Adds a RIGHT JOIN clause to the query using the RoomUser relation
 * @method     ChildRoomQuery innerJoinRoomUser($relationAlias = null) Adds a INNER JOIN clause to the query using the RoomUser relation
 *
 * @method     \RegisteredUserQuery|\MessageQuery|\RoomUserQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildRoom findOne(ConnectionInterface $con = null) Return the first ChildRoom matching the query
 * @method     ChildRoom findOneOrCreate(ConnectionInterface $con = null) Return the first ChildRoom matching the query, or a new ChildRoom object populated from the query conditions when no match is found
 *
 * @method     ChildRoom findOneByRoomid(int $RoomId) Return the first ChildRoom filtered by the RoomId column
 * @method     ChildRoom findOneByCreateddate(string $CreatedDate) Return the first ChildRoom filtered by the CreatedDate column
 * @method     ChildRoom findOneByCreatoruserid(int $CreatorUserId) Return the first ChildRoom filtered by the CreatorUserId column
 * @method     ChildRoom findOneByTopic(string $Topic) Return the first ChildRoom filtered by the Topic column
 * @method     ChildRoom findOneByTimeout(string $Timeout) Return the first ChildRoom filtered by the Timeout column
 * @method     ChildRoom findOneByRating(int $Rating) Return the first ChildRoom filtered by the Rating column
 * @method     ChildRoom findOneByLocationlatitude(double $LocationLatitude) Return the first ChildRoom filtered by the LocationLatitude column
 * @method     ChildRoom findOneByLocationlongitude(double $LocationLongitude) Return the first ChildRoom filtered by the LocationLongitude column
 * @method     ChildRoom findOneByLocationaccuracy(int $LocationAccuracy) Return the first ChildRoom filtered by the LocationAccuracy column
 *
 * @method     ChildRoom[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildRoom objects based on current ModelCriteria
 * @method     ChildRoom[]|ObjectCollection findByRoomid(int $RoomId) Return ChildRoom objects filtered by the RoomId column
 * @method     ChildRoom[]|ObjectCollection findByCreateddate(string $CreatedDate) Return ChildRoom objects filtered by the CreatedDate column
 * @method     ChildRoom[]|ObjectCollection findByCreatoruserid(int $CreatorUserId) Return ChildRoom objects filtered by the CreatorUserId column
 * @method     ChildRoom[]|ObjectCollection findByTopic(string $Topic) Return ChildRoom objects filtered by the Topic column
 * @method     ChildRoom[]|ObjectCollection findByTimeout(string $Timeout) Return ChildRoom objects filtered by the Timeout column
 * @method     ChildRoom[]|ObjectCollection findByRating(int $Rating) Return ChildRoom objects filtered by the Rating column
 * @method     ChildRoom[]|ObjectCollection findByLocationlatitude(double $LocationLatitude) Return ChildRoom objects filtered by the LocationLatitude column
 * @method     ChildRoom[]|ObjectCollection findByLocationlongitude(double $LocationLongitude) Return ChildRoom objects filtered by the LocationLongitude column
 * @method     ChildRoom[]|ObjectCollection findByLocationaccuracy(int $LocationAccuracy) Return ChildRoom objects filtered by the LocationAccuracy column
 * @method     ChildRoom[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class RoomQuery extends ModelCriteria
{

    /**
     * Initializes internal state of \Base\RoomQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'chatstorm', $modelName = '\\Room', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildRoomQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildRoomQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildRoomQuery) {
            return $criteria;
        }
        $query = new ChildRoomQuery();
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
     * $obj = $c->findPk(array(12, 34), $con);
     * </code>
     *
     * @param array[$RoomId, $CreatorUserId] $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildRoom|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = RoomTableMap::getInstanceFromPool(serialize(array((string) $key[0], (string) $key[1]))))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(RoomTableMap::DATABASE_NAME);
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
     * @return ChildRoom A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT RoomId, CreatedDate, CreatorUserId, Topic, Timeout, Rating, LocationLatitude, LocationLongitude, LocationAccuracy FROM Room WHERE RoomId = :p0 AND CreatorUserId = :p1';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key[0], PDO::PARAM_INT);
            $stmt->bindValue(':p1', $key[1], PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildRoom $obj */
            $obj = new ChildRoom();
            $obj->hydrate($row);
            RoomTableMap::addInstanceToPool($obj, serialize(array((string) $key[0], (string) $key[1])));
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
     * @return ChildRoom|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildRoomQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(RoomTableMap::COL_ROOMID, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(RoomTableMap::COL_CREATORUSERID, $key[1], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildRoomQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(RoomTableMap::COL_ROOMID, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(RoomTableMap::COL_CREATORUSERID, $key[1], Criteria::EQUAL);
            $cton0->addAnd($cton1);
            $this->addOr($cton0);
        }

        return $this;
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
     * @return $this|ChildRoomQuery The current query, for fluid interface
     */
    public function filterByRoomid($roomid = null, $comparison = null)
    {
        if (is_array($roomid)) {
            $useMinMax = false;
            if (isset($roomid['min'])) {
                $this->addUsingAlias(RoomTableMap::COL_ROOMID, $roomid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($roomid['max'])) {
                $this->addUsingAlias(RoomTableMap::COL_ROOMID, $roomid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RoomTableMap::COL_ROOMID, $roomid, $comparison);
    }

    /**
     * Filter the query on the CreatedDate column
     *
     * Example usage:
     * <code>
     * $query->filterByCreateddate('2011-03-14'); // WHERE CreatedDate = '2011-03-14'
     * $query->filterByCreateddate('now'); // WHERE CreatedDate = '2011-03-14'
     * $query->filterByCreateddate(array('max' => 'yesterday')); // WHERE CreatedDate > '2011-03-13'
     * </code>
     *
     * @param     mixed $createddate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildRoomQuery The current query, for fluid interface
     */
    public function filterByCreateddate($createddate = null, $comparison = null)
    {
        if (is_array($createddate)) {
            $useMinMax = false;
            if (isset($createddate['min'])) {
                $this->addUsingAlias(RoomTableMap::COL_CREATEDDATE, $createddate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createddate['max'])) {
                $this->addUsingAlias(RoomTableMap::COL_CREATEDDATE, $createddate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RoomTableMap::COL_CREATEDDATE, $createddate, $comparison);
    }

    /**
     * Filter the query on the CreatorUserId column
     *
     * Example usage:
     * <code>
     * $query->filterByCreatoruserid(1234); // WHERE CreatorUserId = 1234
     * $query->filterByCreatoruserid(array(12, 34)); // WHERE CreatorUserId IN (12, 34)
     * $query->filterByCreatoruserid(array('min' => 12)); // WHERE CreatorUserId > 12
     * </code>
     *
     * @see       filterByCreator()
     *
     * @param     mixed $creatoruserid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildRoomQuery The current query, for fluid interface
     */
    public function filterByCreatoruserid($creatoruserid = null, $comparison = null)
    {
        if (is_array($creatoruserid)) {
            $useMinMax = false;
            if (isset($creatoruserid['min'])) {
                $this->addUsingAlias(RoomTableMap::COL_CREATORUSERID, $creatoruserid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($creatoruserid['max'])) {
                $this->addUsingAlias(RoomTableMap::COL_CREATORUSERID, $creatoruserid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RoomTableMap::COL_CREATORUSERID, $creatoruserid, $comparison);
    }

    /**
     * Filter the query on the Topic column
     *
     * Example usage:
     * <code>
     * $query->filterByTopic('fooValue');   // WHERE Topic = 'fooValue'
     * $query->filterByTopic('%fooValue%'); // WHERE Topic LIKE '%fooValue%'
     * </code>
     *
     * @param     string $topic The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildRoomQuery The current query, for fluid interface
     */
    public function filterByTopic($topic = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($topic)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $topic)) {
                $topic = str_replace('*', '%', $topic);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(RoomTableMap::COL_TOPIC, $topic, $comparison);
    }

    /**
     * Filter the query on the Timeout column
     *
     * Example usage:
     * <code>
     * $query->filterByTimeout('2011-03-14'); // WHERE Timeout = '2011-03-14'
     * $query->filterByTimeout('now'); // WHERE Timeout = '2011-03-14'
     * $query->filterByTimeout(array('max' => 'yesterday')); // WHERE Timeout > '2011-03-13'
     * </code>
     *
     * @param     mixed $timeout The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildRoomQuery The current query, for fluid interface
     */
    public function filterByTimeout($timeout = null, $comparison = null)
    {
        if (is_array($timeout)) {
            $useMinMax = false;
            if (isset($timeout['min'])) {
                $this->addUsingAlias(RoomTableMap::COL_TIMEOUT, $timeout['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($timeout['max'])) {
                $this->addUsingAlias(RoomTableMap::COL_TIMEOUT, $timeout['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RoomTableMap::COL_TIMEOUT, $timeout, $comparison);
    }

    /**
     * Filter the query on the Rating column
     *
     * Example usage:
     * <code>
     * $query->filterByRating(1234); // WHERE Rating = 1234
     * $query->filterByRating(array(12, 34)); // WHERE Rating IN (12, 34)
     * $query->filterByRating(array('min' => 12)); // WHERE Rating > 12
     * </code>
     *
     * @param     mixed $rating The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildRoomQuery The current query, for fluid interface
     */
    public function filterByRating($rating = null, $comparison = null)
    {
        if (is_array($rating)) {
            $useMinMax = false;
            if (isset($rating['min'])) {
                $this->addUsingAlias(RoomTableMap::COL_RATING, $rating['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($rating['max'])) {
                $this->addUsingAlias(RoomTableMap::COL_RATING, $rating['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RoomTableMap::COL_RATING, $rating, $comparison);
    }

    /**
     * Filter the query on the LocationLatitude column
     *
     * Example usage:
     * <code>
     * $query->filterByLocationlatitude(1234); // WHERE LocationLatitude = 1234
     * $query->filterByLocationlatitude(array(12, 34)); // WHERE LocationLatitude IN (12, 34)
     * $query->filterByLocationlatitude(array('min' => 12)); // WHERE LocationLatitude > 12
     * </code>
     *
     * @param     mixed $locationlatitude The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildRoomQuery The current query, for fluid interface
     */
    public function filterByLocationlatitude($locationlatitude = null, $comparison = null)
    {
        if (is_array($locationlatitude)) {
            $useMinMax = false;
            if (isset($locationlatitude['min'])) {
                $this->addUsingAlias(RoomTableMap::COL_LOCATIONLATITUDE, $locationlatitude['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($locationlatitude['max'])) {
                $this->addUsingAlias(RoomTableMap::COL_LOCATIONLATITUDE, $locationlatitude['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RoomTableMap::COL_LOCATIONLATITUDE, $locationlatitude, $comparison);
    }

    /**
     * Filter the query on the LocationLongitude column
     *
     * Example usage:
     * <code>
     * $query->filterByLocationlongitude(1234); // WHERE LocationLongitude = 1234
     * $query->filterByLocationlongitude(array(12, 34)); // WHERE LocationLongitude IN (12, 34)
     * $query->filterByLocationlongitude(array('min' => 12)); // WHERE LocationLongitude > 12
     * </code>
     *
     * @param     mixed $locationlongitude The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildRoomQuery The current query, for fluid interface
     */
    public function filterByLocationlongitude($locationlongitude = null, $comparison = null)
    {
        if (is_array($locationlongitude)) {
            $useMinMax = false;
            if (isset($locationlongitude['min'])) {
                $this->addUsingAlias(RoomTableMap::COL_LOCATIONLONGITUDE, $locationlongitude['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($locationlongitude['max'])) {
                $this->addUsingAlias(RoomTableMap::COL_LOCATIONLONGITUDE, $locationlongitude['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RoomTableMap::COL_LOCATIONLONGITUDE, $locationlongitude, $comparison);
    }

    /**
     * Filter the query on the LocationAccuracy column
     *
     * Example usage:
     * <code>
     * $query->filterByLocationaccuracy(1234); // WHERE LocationAccuracy = 1234
     * $query->filterByLocationaccuracy(array(12, 34)); // WHERE LocationAccuracy IN (12, 34)
     * $query->filterByLocationaccuracy(array('min' => 12)); // WHERE LocationAccuracy > 12
     * </code>
     *
     * @param     mixed $locationaccuracy The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildRoomQuery The current query, for fluid interface
     */
    public function filterByLocationaccuracy($locationaccuracy = null, $comparison = null)
    {
        if (is_array($locationaccuracy)) {
            $useMinMax = false;
            if (isset($locationaccuracy['min'])) {
                $this->addUsingAlias(RoomTableMap::COL_LOCATIONACCURACY, $locationaccuracy['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($locationaccuracy['max'])) {
                $this->addUsingAlias(RoomTableMap::COL_LOCATIONACCURACY, $locationaccuracy['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RoomTableMap::COL_LOCATIONACCURACY, $locationaccuracy, $comparison);
    }

    /**
     * Filter the query by a related \RegisteredUser object
     *
     * @param \RegisteredUser|ObjectCollection $registeredUser The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildRoomQuery The current query, for fluid interface
     */
    public function filterByCreator($registeredUser, $comparison = null)
    {
        if ($registeredUser instanceof \RegisteredUser) {
            return $this
                ->addUsingAlias(RoomTableMap::COL_CREATORUSERID, $registeredUser->getRegistereduserid(), $comparison);
        } elseif ($registeredUser instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(RoomTableMap::COL_CREATORUSERID, $registeredUser->toKeyValue('PrimaryKey', 'Registereduserid'), $comparison);
        } else {
            throw new PropelException('filterByCreator() only accepts arguments of type \RegisteredUser or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Creator relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildRoomQuery The current query, for fluid interface
     */
    public function joinCreator($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Creator');

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
            $this->addJoinObject($join, 'Creator');
        }

        return $this;
    }

    /**
     * Use the Creator relation RegisteredUser object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \RegisteredUserQuery A secondary query class using the current class as primary query
     */
    public function useCreatorQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinCreator($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Creator', '\RegisteredUserQuery');
    }

    /**
     * Filter the query by a related \Message object
     *
     * @param \Message|ObjectCollection $message  the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildRoomQuery The current query, for fluid interface
     */
    public function filterByMessage($message, $comparison = null)
    {
        if ($message instanceof \Message) {
            return $this
                ->addUsingAlias(RoomTableMap::COL_ROOMID, $message->getRoomid(), $comparison);
        } elseif ($message instanceof ObjectCollection) {
            return $this
                ->useMessageQuery()
                ->filterByPrimaryKeys($message->getPrimaryKeys())
                ->endUse();
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
     * @return $this|ChildRoomQuery The current query, for fluid interface
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
     * Filter the query by a related \RoomUser object
     *
     * @param \RoomUser|ObjectCollection $roomUser  the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildRoomQuery The current query, for fluid interface
     */
    public function filterByRoomUser($roomUser, $comparison = null)
    {
        if ($roomUser instanceof \RoomUser) {
            return $this
                ->addUsingAlias(RoomTableMap::COL_ROOMID, $roomUser->getRoomid(), $comparison);
        } elseif ($roomUser instanceof ObjectCollection) {
            return $this
                ->useRoomUserQuery()
                ->filterByPrimaryKeys($roomUser->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByRoomUser() only accepts arguments of type \RoomUser or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the RoomUser relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildRoomQuery The current query, for fluid interface
     */
    public function joinRoomUser($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('RoomUser');

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
            $this->addJoinObject($join, 'RoomUser');
        }

        return $this;
    }

    /**
     * Use the RoomUser relation RoomUser object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \RoomUserQuery A secondary query class using the current class as primary query
     */
    public function useRoomUserQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinRoomUser($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'RoomUser', '\RoomUserQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildRoom $room Object to remove from the list of results
     *
     * @return $this|ChildRoomQuery The current query, for fluid interface
     */
    public function prune($room = null)
    {
        if ($room) {
            $this->addCond('pruneCond0', $this->getAliasedColName(RoomTableMap::COL_ROOMID), $room->getRoomid(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(RoomTableMap::COL_CREATORUSERID), $room->getCreatoruserid(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

    /**
     * Deletes all rows from the Room table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(RoomTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            RoomTableMap::clearInstancePool();
            RoomTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(RoomTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(RoomTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            RoomTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            RoomTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // RoomQuery
