<?php

namespace Base;

use \RegisteredUser as ChildRegisteredUser;
use \RegisteredUserQuery as ChildRegisteredUserQuery;
use \Exception;
use \PDO;
use Map\RegisteredUserTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'RegisteredUser' table.
 *
 *
 *
 * @method     ChildRegisteredUserQuery orderByRegistereduserid($order = Criteria::ASC) Order by the RegisteredUserId column
 * @method     ChildRegisteredUserQuery orderByEmail($order = Criteria::ASC) Order by the Email column
 * @method     ChildRegisteredUserQuery orderByPasswordhash($order = Criteria::ASC) Order by the PasswordHash column
 * @method     ChildRegisteredUserQuery orderByActivationkey($order = Criteria::ASC) Order by the ActivationKey column
 * @method     ChildRegisteredUserQuery orderByRegistereddate($order = Criteria::ASC) Order by the RegisteredDate column
 * @method     ChildRegisteredUserQuery orderByActivationdate($order = Criteria::ASC) Order by the ActivationDate column
 * @method     ChildRegisteredUserQuery orderByActivated($order = Criteria::ASC) Order by the Activated column
 * @method     ChildRegisteredUserQuery orderByRating($order = Criteria::ASC) Order by the Rating column
 * @method     ChildRegisteredUserQuery orderByLocationlatitude($order = Criteria::ASC) Order by the LocationLatitude column
 * @method     ChildRegisteredUserQuery orderByLocationlongitude($order = Criteria::ASC) Order by the LocationLongitude column
 * @method     ChildRegisteredUserQuery orderByLocationaccuracy($order = Criteria::ASC) Order by the LocationAccuracy column
 * @method     ChildRegisteredUserQuery orderByImei($order = Criteria::ASC) Order by the IMEI column
 *
 * @method     ChildRegisteredUserQuery groupByRegistereduserid() Group by the RegisteredUserId column
 * @method     ChildRegisteredUserQuery groupByEmail() Group by the Email column
 * @method     ChildRegisteredUserQuery groupByPasswordhash() Group by the PasswordHash column
 * @method     ChildRegisteredUserQuery groupByActivationkey() Group by the ActivationKey column
 * @method     ChildRegisteredUserQuery groupByRegistereddate() Group by the RegisteredDate column
 * @method     ChildRegisteredUserQuery groupByActivationdate() Group by the ActivationDate column
 * @method     ChildRegisteredUserQuery groupByActivated() Group by the Activated column
 * @method     ChildRegisteredUserQuery groupByRating() Group by the Rating column
 * @method     ChildRegisteredUserQuery groupByLocationlatitude() Group by the LocationLatitude column
 * @method     ChildRegisteredUserQuery groupByLocationlongitude() Group by the LocationLongitude column
 * @method     ChildRegisteredUserQuery groupByLocationaccuracy() Group by the LocationAccuracy column
 * @method     ChildRegisteredUserQuery groupByImei() Group by the IMEI column
 *
 * @method     ChildRegisteredUserQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildRegisteredUserQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildRegisteredUserQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildRegisteredUserQuery leftJoinRoomUser($relationAlias = null) Adds a LEFT JOIN clause to the query using the RoomUser relation
 * @method     ChildRegisteredUserQuery rightJoinRoomUser($relationAlias = null) Adds a RIGHT JOIN clause to the query using the RoomUser relation
 * @method     ChildRegisteredUserQuery innerJoinRoomUser($relationAlias = null) Adds a INNER JOIN clause to the query using the RoomUser relation
 *
 * @method     \RoomUserQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildRegisteredUser findOne(ConnectionInterface $con = null) Return the first ChildRegisteredUser matching the query
 * @method     ChildRegisteredUser findOneOrCreate(ConnectionInterface $con = null) Return the first ChildRegisteredUser matching the query, or a new ChildRegisteredUser object populated from the query conditions when no match is found
 *
 * @method     ChildRegisteredUser findOneByRegistereduserid(int $RegisteredUserId) Return the first ChildRegisteredUser filtered by the RegisteredUserId column
 * @method     ChildRegisteredUser findOneByEmail(string $Email) Return the first ChildRegisteredUser filtered by the Email column
 * @method     ChildRegisteredUser findOneByPasswordhash(string $PasswordHash) Return the first ChildRegisteredUser filtered by the PasswordHash column
 * @method     ChildRegisteredUser findOneByActivationkey(string $ActivationKey) Return the first ChildRegisteredUser filtered by the ActivationKey column
 * @method     ChildRegisteredUser findOneByRegistereddate(string $RegisteredDate) Return the first ChildRegisteredUser filtered by the RegisteredDate column
 * @method     ChildRegisteredUser findOneByActivationdate(string $ActivationDate) Return the first ChildRegisteredUser filtered by the ActivationDate column
 * @method     ChildRegisteredUser findOneByActivated(boolean $Activated) Return the first ChildRegisteredUser filtered by the Activated column
 * @method     ChildRegisteredUser findOneByRating(int $Rating) Return the first ChildRegisteredUser filtered by the Rating column
 * @method     ChildRegisteredUser findOneByLocationlatitude(double $LocationLatitude) Return the first ChildRegisteredUser filtered by the LocationLatitude column
 * @method     ChildRegisteredUser findOneByLocationlongitude(double $LocationLongitude) Return the first ChildRegisteredUser filtered by the LocationLongitude column
 * @method     ChildRegisteredUser findOneByLocationaccuracy(int $LocationAccuracy) Return the first ChildRegisteredUser filtered by the LocationAccuracy column
 * @method     ChildRegisteredUser findOneByImei(string $IMEI) Return the first ChildRegisteredUser filtered by the IMEI column
 *
 * @method     ChildRegisteredUser[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildRegisteredUser objects based on current ModelCriteria
 * @method     ChildRegisteredUser[]|ObjectCollection findByRegistereduserid(int $RegisteredUserId) Return ChildRegisteredUser objects filtered by the RegisteredUserId column
 * @method     ChildRegisteredUser[]|ObjectCollection findByEmail(string $Email) Return ChildRegisteredUser objects filtered by the Email column
 * @method     ChildRegisteredUser[]|ObjectCollection findByPasswordhash(string $PasswordHash) Return ChildRegisteredUser objects filtered by the PasswordHash column
 * @method     ChildRegisteredUser[]|ObjectCollection findByActivationkey(string $ActivationKey) Return ChildRegisteredUser objects filtered by the ActivationKey column
 * @method     ChildRegisteredUser[]|ObjectCollection findByRegistereddate(string $RegisteredDate) Return ChildRegisteredUser objects filtered by the RegisteredDate column
 * @method     ChildRegisteredUser[]|ObjectCollection findByActivationdate(string $ActivationDate) Return ChildRegisteredUser objects filtered by the ActivationDate column
 * @method     ChildRegisteredUser[]|ObjectCollection findByActivated(boolean $Activated) Return ChildRegisteredUser objects filtered by the Activated column
 * @method     ChildRegisteredUser[]|ObjectCollection findByRating(int $Rating) Return ChildRegisteredUser objects filtered by the Rating column
 * @method     ChildRegisteredUser[]|ObjectCollection findByLocationlatitude(double $LocationLatitude) Return ChildRegisteredUser objects filtered by the LocationLatitude column
 * @method     ChildRegisteredUser[]|ObjectCollection findByLocationlongitude(double $LocationLongitude) Return ChildRegisteredUser objects filtered by the LocationLongitude column
 * @method     ChildRegisteredUser[]|ObjectCollection findByLocationaccuracy(int $LocationAccuracy) Return ChildRegisteredUser objects filtered by the LocationAccuracy column
 * @method     ChildRegisteredUser[]|ObjectCollection findByImei(string $IMEI) Return ChildRegisteredUser objects filtered by the IMEI column
 * @method     ChildRegisteredUser[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class RegisteredUserQuery extends ModelCriteria
{

    /**
     * Initializes internal state of \Base\RegisteredUserQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'chatstorm', $modelName = '\\RegisteredUser', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildRegisteredUserQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildRegisteredUserQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildRegisteredUserQuery) {
            return $criteria;
        }
        $query = new ChildRegisteredUserQuery();
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
     * @return ChildRegisteredUser|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = RegisteredUserTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(RegisteredUserTableMap::DATABASE_NAME);
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
     * @return ChildRegisteredUser A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT RegisteredUserId, Email, PasswordHash, ActivationKey, RegisteredDate, ActivationDate, Activated, Rating, LocationLatitude, LocationLongitude, LocationAccuracy, IMEI FROM RegisteredUser WHERE RegisteredUserId = :p0';
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
            /** @var ChildRegisteredUser $obj */
            $obj = new ChildRegisteredUser();
            $obj->hydrate($row);
            RegisteredUserTableMap::addInstanceToPool($obj, (string) $key);
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
     * @return ChildRegisteredUser|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildRegisteredUserQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(RegisteredUserTableMap::COL_REGISTEREDUSERID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildRegisteredUserQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(RegisteredUserTableMap::COL_REGISTEREDUSERID, $keys, Criteria::IN);
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
     * @param     mixed $registereduserid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildRegisteredUserQuery The current query, for fluid interface
     */
    public function filterByRegistereduserid($registereduserid = null, $comparison = null)
    {
        if (is_array($registereduserid)) {
            $useMinMax = false;
            if (isset($registereduserid['min'])) {
                $this->addUsingAlias(RegisteredUserTableMap::COL_REGISTEREDUSERID, $registereduserid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($registereduserid['max'])) {
                $this->addUsingAlias(RegisteredUserTableMap::COL_REGISTEREDUSERID, $registereduserid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RegisteredUserTableMap::COL_REGISTEREDUSERID, $registereduserid, $comparison);
    }

    /**
     * Filter the query on the Email column
     *
     * Example usage:
     * <code>
     * $query->filterByEmail('fooValue');   // WHERE Email = 'fooValue'
     * $query->filterByEmail('%fooValue%'); // WHERE Email LIKE '%fooValue%'
     * </code>
     *
     * @param     string $email The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildRegisteredUserQuery The current query, for fluid interface
     */
    public function filterByEmail($email = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($email)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $email)) {
                $email = str_replace('*', '%', $email);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(RegisteredUserTableMap::COL_EMAIL, $email, $comparison);
    }

    /**
     * Filter the query on the PasswordHash column
     *
     * Example usage:
     * <code>
     * $query->filterByPasswordhash('fooValue');   // WHERE PasswordHash = 'fooValue'
     * $query->filterByPasswordhash('%fooValue%'); // WHERE PasswordHash LIKE '%fooValue%'
     * </code>
     *
     * @param     string $passwordhash The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildRegisteredUserQuery The current query, for fluid interface
     */
    public function filterByPasswordhash($passwordhash = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($passwordhash)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $passwordhash)) {
                $passwordhash = str_replace('*', '%', $passwordhash);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(RegisteredUserTableMap::COL_PASSWORDHASH, $passwordhash, $comparison);
    }

    /**
     * Filter the query on the ActivationKey column
     *
     * Example usage:
     * <code>
     * $query->filterByActivationkey('fooValue');   // WHERE ActivationKey = 'fooValue'
     * $query->filterByActivationkey('%fooValue%'); // WHERE ActivationKey LIKE '%fooValue%'
     * </code>
     *
     * @param     string $activationkey The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildRegisteredUserQuery The current query, for fluid interface
     */
    public function filterByActivationkey($activationkey = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($activationkey)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $activationkey)) {
                $activationkey = str_replace('*', '%', $activationkey);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(RegisteredUserTableMap::COL_ACTIVATIONKEY, $activationkey, $comparison);
    }

    /**
     * Filter the query on the RegisteredDate column
     *
     * Example usage:
     * <code>
     * $query->filterByRegistereddate('2011-03-14'); // WHERE RegisteredDate = '2011-03-14'
     * $query->filterByRegistereddate('now'); // WHERE RegisteredDate = '2011-03-14'
     * $query->filterByRegistereddate(array('max' => 'yesterday')); // WHERE RegisteredDate > '2011-03-13'
     * </code>
     *
     * @param     mixed $registereddate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildRegisteredUserQuery The current query, for fluid interface
     */
    public function filterByRegistereddate($registereddate = null, $comparison = null)
    {
        if (is_array($registereddate)) {
            $useMinMax = false;
            if (isset($registereddate['min'])) {
                $this->addUsingAlias(RegisteredUserTableMap::COL_REGISTEREDDATE, $registereddate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($registereddate['max'])) {
                $this->addUsingAlias(RegisteredUserTableMap::COL_REGISTEREDDATE, $registereddate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RegisteredUserTableMap::COL_REGISTEREDDATE, $registereddate, $comparison);
    }

    /**
     * Filter the query on the ActivationDate column
     *
     * Example usage:
     * <code>
     * $query->filterByActivationdate('2011-03-14'); // WHERE ActivationDate = '2011-03-14'
     * $query->filterByActivationdate('now'); // WHERE ActivationDate = '2011-03-14'
     * $query->filterByActivationdate(array('max' => 'yesterday')); // WHERE ActivationDate > '2011-03-13'
     * </code>
     *
     * @param     mixed $activationdate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildRegisteredUserQuery The current query, for fluid interface
     */
    public function filterByActivationdate($activationdate = null, $comparison = null)
    {
        if (is_array($activationdate)) {
            $useMinMax = false;
            if (isset($activationdate['min'])) {
                $this->addUsingAlias(RegisteredUserTableMap::COL_ACTIVATIONDATE, $activationdate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($activationdate['max'])) {
                $this->addUsingAlias(RegisteredUserTableMap::COL_ACTIVATIONDATE, $activationdate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RegisteredUserTableMap::COL_ACTIVATIONDATE, $activationdate, $comparison);
    }

    /**
     * Filter the query on the Activated column
     *
     * Example usage:
     * <code>
     * $query->filterByActivated(true); // WHERE Activated = true
     * $query->filterByActivated('yes'); // WHERE Activated = true
     * </code>
     *
     * @param     boolean|string $activated The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildRegisteredUserQuery The current query, for fluid interface
     */
    public function filterByActivated($activated = null, $comparison = null)
    {
        if (is_string($activated)) {
            $activated = in_array(strtolower($activated), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(RegisteredUserTableMap::COL_ACTIVATED, $activated, $comparison);
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
     * @return $this|ChildRegisteredUserQuery The current query, for fluid interface
     */
    public function filterByRating($rating = null, $comparison = null)
    {
        if (is_array($rating)) {
            $useMinMax = false;
            if (isset($rating['min'])) {
                $this->addUsingAlias(RegisteredUserTableMap::COL_RATING, $rating['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($rating['max'])) {
                $this->addUsingAlias(RegisteredUserTableMap::COL_RATING, $rating['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RegisteredUserTableMap::COL_RATING, $rating, $comparison);
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
     * @return $this|ChildRegisteredUserQuery The current query, for fluid interface
     */
    public function filterByLocationlatitude($locationlatitude = null, $comparison = null)
    {
        if (is_array($locationlatitude)) {
            $useMinMax = false;
            if (isset($locationlatitude['min'])) {
                $this->addUsingAlias(RegisteredUserTableMap::COL_LOCATIONLATITUDE, $locationlatitude['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($locationlatitude['max'])) {
                $this->addUsingAlias(RegisteredUserTableMap::COL_LOCATIONLATITUDE, $locationlatitude['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RegisteredUserTableMap::COL_LOCATIONLATITUDE, $locationlatitude, $comparison);
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
     * @return $this|ChildRegisteredUserQuery The current query, for fluid interface
     */
    public function filterByLocationlongitude($locationlongitude = null, $comparison = null)
    {
        if (is_array($locationlongitude)) {
            $useMinMax = false;
            if (isset($locationlongitude['min'])) {
                $this->addUsingAlias(RegisteredUserTableMap::COL_LOCATIONLONGITUDE, $locationlongitude['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($locationlongitude['max'])) {
                $this->addUsingAlias(RegisteredUserTableMap::COL_LOCATIONLONGITUDE, $locationlongitude['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RegisteredUserTableMap::COL_LOCATIONLONGITUDE, $locationlongitude, $comparison);
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
     * @return $this|ChildRegisteredUserQuery The current query, for fluid interface
     */
    public function filterByLocationaccuracy($locationaccuracy = null, $comparison = null)
    {
        if (is_array($locationaccuracy)) {
            $useMinMax = false;
            if (isset($locationaccuracy['min'])) {
                $this->addUsingAlias(RegisteredUserTableMap::COL_LOCATIONACCURACY, $locationaccuracy['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($locationaccuracy['max'])) {
                $this->addUsingAlias(RegisteredUserTableMap::COL_LOCATIONACCURACY, $locationaccuracy['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RegisteredUserTableMap::COL_LOCATIONACCURACY, $locationaccuracy, $comparison);
    }

    /**
     * Filter the query on the IMEI column
     *
     * Example usage:
     * <code>
     * $query->filterByImei('fooValue');   // WHERE IMEI = 'fooValue'
     * $query->filterByImei('%fooValue%'); // WHERE IMEI LIKE '%fooValue%'
     * </code>
     *
     * @param     string $imei The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildRegisteredUserQuery The current query, for fluid interface
     */
    public function filterByImei($imei = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($imei)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $imei)) {
                $imei = str_replace('*', '%', $imei);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(RegisteredUserTableMap::COL_IMEI, $imei, $comparison);
    }

    /**
     * Filter the query by a related \RoomUser object
     *
     * @param \RoomUser|ObjectCollection $roomUser  the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildRegisteredUserQuery The current query, for fluid interface
     */
    public function filterByRoomUser($roomUser, $comparison = null)
    {
        if ($roomUser instanceof \RoomUser) {
            return $this
                ->addUsingAlias(RegisteredUserTableMap::COL_REGISTEREDUSERID, $roomUser->getRegistereduserid(), $comparison);
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
     * @return $this|ChildRegisteredUserQuery The current query, for fluid interface
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
     * @param   ChildRegisteredUser $registeredUser Object to remove from the list of results
     *
     * @return $this|ChildRegisteredUserQuery The current query, for fluid interface
     */
    public function prune($registeredUser = null)
    {
        if ($registeredUser) {
            $this->addUsingAlias(RegisteredUserTableMap::COL_REGISTEREDUSERID, $registeredUser->getRegistereduserid(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the RegisteredUser table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(RegisteredUserTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            RegisteredUserTableMap::clearInstancePool();
            RegisteredUserTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(RegisteredUserTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(RegisteredUserTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            RegisteredUserTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            RegisteredUserTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // RegisteredUserQuery
