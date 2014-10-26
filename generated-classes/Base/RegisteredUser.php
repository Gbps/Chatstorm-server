<?php

namespace Base;

use \RegisteredUser as ChildRegisteredUser;
use \RegisteredUserQuery as ChildRegisteredUserQuery;
use \Room as ChildRoom;
use \RoomQuery as ChildRoomQuery;
use \RoomUser as ChildRoomUser;
use \RoomUserQuery as ChildRoomUserQuery;
use \DateTime;
use \Exception;
use \PDO;
use Map\RegisteredUserTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveRecord\ActiveRecordInterface;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\BadMethodCallException;
use Propel\Runtime\Exception\LogicException;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Parser\AbstractParser;
use Propel\Runtime\Util\PropelDateTime;

/**
 * Base class that represents a row from the 'RegisteredUser' table.
 *
 *
 *
* @package    propel.generator..Base
*/
abstract class RegisteredUser implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\Map\\RegisteredUserTableMap';


    /**
     * attribute to determine if this object has previously been saved.
     * @var boolean
     */
    protected $new = true;

    /**
     * attribute to determine whether this object has been deleted.
     * @var boolean
     */
    protected $deleted = false;

    /**
     * The columns that have been modified in current object.
     * Tracking modified columns allows us to only update modified columns.
     * @var array
     */
    protected $modifiedColumns = array();

    /**
     * The (virtual) columns that are added at runtime
     * The formatters can add supplementary columns based on a resultset
     * @var array
     */
    protected $virtualColumns = array();

    /**
     * The value for the registereduserid field.
     * @var        int
     */
    protected $registereduserid;

    /**
     * The value for the email field.
     * @var        string
     */
    protected $email;

    /**
     * The value for the passwordhash field.
     * @var        string
     */
    protected $passwordhash;

    /**
     * The value for the activationkey field.
     * @var        string
     */
    protected $activationkey;

    /**
     * The value for the registereddate field.
     * @var        \DateTime
     */
    protected $registereddate;

    /**
     * The value for the activationdate field.
     * @var        \DateTime
     */
    protected $activationdate;

    /**
     * The value for the activated field.
     * @var        boolean
     */
    protected $activated;

    /**
     * The value for the rating field.
     * @var        int
     */
    protected $rating;

    /**
     * The value for the locationlatitude field.
     * @var        double
     */
    protected $locationlatitude;

    /**
     * The value for the locationlongitude field.
     * @var        double
     */
    protected $locationlongitude;

    /**
     * The value for the locationaccuracy field.
     * @var        int
     */
    protected $locationaccuracy;

    /**
     * The value for the imei field.
     * @var        string
     */
    protected $imei;

    /**
     * @var        ObjectCollection|ChildRoom[] Collection to store aggregation of ChildRoom objects.
     */
    protected $collRooms;
    protected $collRoomsPartial;

    /**
     * @var        ObjectCollection|ChildRoomUser[] Collection to store aggregation of ChildRoomUser objects.
     */
    protected $collRoomUsers;
    protected $collRoomUsersPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildRoom[]
     */
    protected $roomsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildRoomUser[]
     */
    protected $roomUsersScheduledForDeletion = null;

    /**
     * Initializes internal state of Base\RegisteredUser object.
     */
    public function __construct()
    {
    }

    /**
     * Returns whether the object has been modified.
     *
     * @return boolean True if the object has been modified.
     */
    public function isModified()
    {
        return !!$this->modifiedColumns;
    }

    /**
     * Has specified column been modified?
     *
     * @param  string  $col column fully qualified name (TableMap::TYPE_COLNAME), e.g. Book::AUTHOR_ID
     * @return boolean True if $col has been modified.
     */
    public function isColumnModified($col)
    {
        return $this->modifiedColumns && isset($this->modifiedColumns[$col]);
    }

    /**
     * Get the columns that have been modified in this object.
     * @return array A unique list of the modified column names for this object.
     */
    public function getModifiedColumns()
    {
        return $this->modifiedColumns ? array_keys($this->modifiedColumns) : [];
    }

    /**
     * Returns whether the object has ever been saved.  This will
     * be false, if the object was retrieved from storage or was created
     * and then saved.
     *
     * @return boolean true, if the object has never been persisted.
     */
    public function isNew()
    {
        return $this->new;
    }

    /**
     * Setter for the isNew attribute.  This method will be called
     * by Propel-generated children and objects.
     *
     * @param boolean $b the state of the object.
     */
    public function setNew($b)
    {
        $this->new = (boolean) $b;
    }

    /**
     * Whether this object has been deleted.
     * @return boolean The deleted state of this object.
     */
    public function isDeleted()
    {
        return $this->deleted;
    }

    /**
     * Specify whether this object has been deleted.
     * @param  boolean $b The deleted state of this object.
     * @return void
     */
    public function setDeleted($b)
    {
        $this->deleted = (boolean) $b;
    }

    /**
     * Sets the modified state for the object to be false.
     * @param  string $col If supplied, only the specified column is reset.
     * @return void
     */
    public function resetModified($col = null)
    {
        if (null !== $col) {
            if (isset($this->modifiedColumns[$col])) {
                unset($this->modifiedColumns[$col]);
            }
        } else {
            $this->modifiedColumns = array();
        }
    }

    /**
     * Compares this with another <code>RegisteredUser</code> instance.  If
     * <code>obj</code> is an instance of <code>RegisteredUser</code>, delegates to
     * <code>equals(RegisteredUser)</code>.  Otherwise, returns <code>false</code>.
     *
     * @param  mixed   $obj The object to compare to.
     * @return boolean Whether equal to the object specified.
     */
    public function equals($obj)
    {
        if (!$obj instanceof static) {
            return false;
        }

        if ($this === $obj) {
            return true;
        }

        if (null === $this->getPrimaryKey() || null === $obj->getPrimaryKey()) {
            return false;
        }

        return $this->getPrimaryKey() === $obj->getPrimaryKey();
    }

    /**
     * Get the associative array of the virtual columns in this object
     *
     * @return array
     */
    public function getVirtualColumns()
    {
        return $this->virtualColumns;
    }

    /**
     * Checks the existence of a virtual column in this object
     *
     * @param  string  $name The virtual column name
     * @return boolean
     */
    public function hasVirtualColumn($name)
    {
        return array_key_exists($name, $this->virtualColumns);
    }

    /**
     * Get the value of a virtual column in this object
     *
     * @param  string $name The virtual column name
     * @return mixed
     *
     * @throws PropelException
     */
    public function getVirtualColumn($name)
    {
        if (!$this->hasVirtualColumn($name)) {
            throw new PropelException(sprintf('Cannot get value of inexistent virtual column %s.', $name));
        }

        return $this->virtualColumns[$name];
    }

    /**
     * Set the value of a virtual column in this object
     *
     * @param string $name  The virtual column name
     * @param mixed  $value The value to give to the virtual column
     *
     * @return $this|RegisteredUser The current object, for fluid interface
     */
    public function setVirtualColumn($name, $value)
    {
        $this->virtualColumns[$name] = $value;

        return $this;
    }

    /**
     * Logs a message using Propel::log().
     *
     * @param  string  $msg
     * @param  int     $priority One of the Propel::LOG_* logging levels
     * @return boolean
     */
    protected function log($msg, $priority = Propel::LOG_INFO)
    {
        return Propel::log(get_class($this) . ': ' . $msg, $priority);
    }

    /**
     * Export the current object properties to a string, using a given parser format
     * <code>
     * $book = BookQuery::create()->findPk(9012);
     * echo $book->exportTo('JSON');
     *  => {"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * @param  mixed   $parser                 A AbstractParser instance, or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param  boolean $includeLazyLoadColumns (optional) Whether to include lazy load(ed) columns. Defaults to TRUE.
     * @return string  The exported data
     */
    public function exportTo($parser, $includeLazyLoadColumns = true)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        return $parser->fromArray($this->toArray(TableMap::TYPE_PHPNAME, $includeLazyLoadColumns, array(), true));
    }

    /**
     * Clean up internal collections prior to serializing
     * Avoids recursive loops that turn into segmentation faults when serializing
     */
    public function __sleep()
    {
        $this->clearAllReferences();

        return array_keys(get_object_vars($this));
    }

    /**
     * Get the [registereduserid] column value.
     *
     * @return int
     */
    public function getRegistereduserid()
    {
        return $this->registereduserid;
    }

    /**
     * Get the [email] column value.
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Get the [passwordhash] column value.
     *
     * @return string
     */
    public function getPasswordhash()
    {
        return $this->passwordhash;
    }

    /**
     * Get the [activationkey] column value.
     *
     * @return string
     */
    public function getActivationkey()
    {
        return $this->activationkey;
    }

    /**
     * Get the [optionally formatted] temporal [registereddate] column value.
     *
     *
     * @param      string $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getRegistereddate($format = NULL)
    {
        if ($format === null) {
            return $this->registereddate;
        } else {
            return $this->registereddate instanceof \DateTime ? $this->registereddate->format($format) : null;
        }
    }

    /**
     * Get the [optionally formatted] temporal [activationdate] column value.
     *
     *
     * @param      string $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getActivationdate($format = NULL)
    {
        if ($format === null) {
            return $this->activationdate;
        } else {
            return $this->activationdate instanceof \DateTime ? $this->activationdate->format($format) : null;
        }
    }

    /**
     * Get the [activated] column value.
     *
     * @return boolean
     */
    public function getActivated()
    {
        return $this->activated;
    }

    /**
     * Get the [activated] column value.
     *
     * @return boolean
     */
    public function isActivated()
    {
        return $this->getActivated();
    }

    /**
     * Get the [rating] column value.
     *
     * @return int
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * Get the [locationlatitude] column value.
     *
     * @return double
     */
    public function getLocationlatitude()
    {
        return $this->locationlatitude;
    }

    /**
     * Get the [locationlongitude] column value.
     *
     * @return double
     */
    public function getLocationlongitude()
    {
        return $this->locationlongitude;
    }

    /**
     * Get the [locationaccuracy] column value.
     *
     * @return int
     */
    public function getLocationaccuracy()
    {
        return $this->locationaccuracy;
    }

    /**
     * Get the [imei] column value.
     *
     * @return string
     */
    public function getImei()
    {
        return $this->imei;
    }

    /**
     * Set the value of [registereduserid] column.
     *
     * @param  int $v new value
     * @return $this|\RegisteredUser The current object (for fluent API support)
     */
    public function setRegistereduserid($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->registereduserid !== $v) {
            $this->registereduserid = $v;
            $this->modifiedColumns[RegisteredUserTableMap::COL_REGISTEREDUSERID] = true;
        }

        return $this;
    } // setRegistereduserid()

    /**
     * Set the value of [email] column.
     *
     * @param  string $v new value
     * @return $this|\RegisteredUser The current object (for fluent API support)
     */
    public function setEmail($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->email !== $v) {
            $this->email = $v;
            $this->modifiedColumns[RegisteredUserTableMap::COL_EMAIL] = true;
        }

        return $this;
    } // setEmail()

    /**
     * Set the value of [passwordhash] column.
     *
     * @param  string $v new value
     * @return $this|\RegisteredUser The current object (for fluent API support)
     */
    public function setPasswordhash($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->passwordhash !== $v) {
            $this->passwordhash = $v;
            $this->modifiedColumns[RegisteredUserTableMap::COL_PASSWORDHASH] = true;
        }

        return $this;
    } // setPasswordhash()

    /**
     * Set the value of [activationkey] column.
     *
     * @param  string $v new value
     * @return $this|\RegisteredUser The current object (for fluent API support)
     */
    public function setActivationkey($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->activationkey !== $v) {
            $this->activationkey = $v;
            $this->modifiedColumns[RegisteredUserTableMap::COL_ACTIVATIONKEY] = true;
        }

        return $this;
    } // setActivationkey()

    /**
     * Sets the value of [registereddate] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTime value.
     *               Empty strings are treated as NULL.
     * @return $this|\RegisteredUser The current object (for fluent API support)
     */
    public function setRegistereddate($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->registereddate !== null || $dt !== null) {
            if ($dt !== $this->registereddate) {
                $this->registereddate = $dt;
                $this->modifiedColumns[RegisteredUserTableMap::COL_REGISTEREDDATE] = true;
            }
        } // if either are not null

        return $this;
    } // setRegistereddate()

    /**
     * Sets the value of [activationdate] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTime value.
     *               Empty strings are treated as NULL.
     * @return $this|\RegisteredUser The current object (for fluent API support)
     */
    public function setActivationdate($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->activationdate !== null || $dt !== null) {
            if ($dt !== $this->activationdate) {
                $this->activationdate = $dt;
                $this->modifiedColumns[RegisteredUserTableMap::COL_ACTIVATIONDATE] = true;
            }
        } // if either are not null

        return $this;
    } // setActivationdate()

    /**
     * Sets the value of the [activated] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param  boolean|integer|string $v The new value
     * @return $this|\RegisteredUser The current object (for fluent API support)
     */
    public function setActivated($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->activated !== $v) {
            $this->activated = $v;
            $this->modifiedColumns[RegisteredUserTableMap::COL_ACTIVATED] = true;
        }

        return $this;
    } // setActivated()

    /**
     * Set the value of [rating] column.
     *
     * @param  int $v new value
     * @return $this|\RegisteredUser The current object (for fluent API support)
     */
    public function setRating($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->rating !== $v) {
            $this->rating = $v;
            $this->modifiedColumns[RegisteredUserTableMap::COL_RATING] = true;
        }

        return $this;
    } // setRating()

    /**
     * Set the value of [locationlatitude] column.
     *
     * @param  double $v new value
     * @return $this|\RegisteredUser The current object (for fluent API support)
     */
    public function setLocationlatitude($v)
    {
        if ($v !== null) {
            $v = (double) $v;
        }

        if ($this->locationlatitude !== $v) {
            $this->locationlatitude = $v;
            $this->modifiedColumns[RegisteredUserTableMap::COL_LOCATIONLATITUDE] = true;
        }

        return $this;
    } // setLocationlatitude()

    /**
     * Set the value of [locationlongitude] column.
     *
     * @param  double $v new value
     * @return $this|\RegisteredUser The current object (for fluent API support)
     */
    public function setLocationlongitude($v)
    {
        if ($v !== null) {
            $v = (double) $v;
        }

        if ($this->locationlongitude !== $v) {
            $this->locationlongitude = $v;
            $this->modifiedColumns[RegisteredUserTableMap::COL_LOCATIONLONGITUDE] = true;
        }

        return $this;
    } // setLocationlongitude()

    /**
     * Set the value of [locationaccuracy] column.
     *
     * @param  int $v new value
     * @return $this|\RegisteredUser The current object (for fluent API support)
     */
    public function setLocationaccuracy($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->locationaccuracy !== $v) {
            $this->locationaccuracy = $v;
            $this->modifiedColumns[RegisteredUserTableMap::COL_LOCATIONACCURACY] = true;
        }

        return $this;
    } // setLocationaccuracy()

    /**
     * Set the value of [imei] column.
     *
     * @param  string $v new value
     * @return $this|\RegisteredUser The current object (for fluent API support)
     */
    public function setImei($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->imei !== $v) {
            $this->imei = $v;
            $this->modifiedColumns[RegisteredUserTableMap::COL_IMEI] = true;
        }

        return $this;
    } // setImei()

    /**
     * Indicates whether the columns in this object are only set to default values.
     *
     * This method can be used in conjunction with isModified() to indicate whether an object is both
     * modified _and_ has some values set which are non-default.
     *
     * @return boolean Whether the columns in this object are only been set with default values.
     */
    public function hasOnlyDefaultValues()
    {
        // otherwise, everything was equal, so return TRUE
        return true;
    } // hasOnlyDefaultValues()

    /**
     * Hydrates (populates) the object variables with values from the database resultset.
     *
     * An offset (0-based "start column") is specified so that objects can be hydrated
     * with a subset of the columns in the resultset rows.  This is needed, for example,
     * for results of JOIN queries where the resultset row includes columns from two or
     * more tables.
     *
     * @param array   $row       The row returned by DataFetcher->fetch().
     * @param int     $startcol  0-based offset column which indicates which restultset column to start with.
     * @param boolean $rehydrate Whether this object is being re-hydrated from the database.
     * @param string  $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                  One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                            TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @return int             next starting column
     * @throws PropelException - Any caught Exception will be rewrapped as a PropelException.
     */
    public function hydrate($row, $startcol = 0, $rehydrate = false, $indexType = TableMap::TYPE_NUM)
    {
        try {

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : RegisteredUserTableMap::translateFieldName('Registereduserid', TableMap::TYPE_PHPNAME, $indexType)];
            $this->registereduserid = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : RegisteredUserTableMap::translateFieldName('Email', TableMap::TYPE_PHPNAME, $indexType)];
            $this->email = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : RegisteredUserTableMap::translateFieldName('Passwordhash', TableMap::TYPE_PHPNAME, $indexType)];
            $this->passwordhash = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : RegisteredUserTableMap::translateFieldName('Activationkey', TableMap::TYPE_PHPNAME, $indexType)];
            $this->activationkey = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : RegisteredUserTableMap::translateFieldName('Registereddate', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->registereddate = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : RegisteredUserTableMap::translateFieldName('Activationdate', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->activationdate = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : RegisteredUserTableMap::translateFieldName('Activated', TableMap::TYPE_PHPNAME, $indexType)];
            $this->activated = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : RegisteredUserTableMap::translateFieldName('Rating', TableMap::TYPE_PHPNAME, $indexType)];
            $this->rating = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : RegisteredUserTableMap::translateFieldName('Locationlatitude', TableMap::TYPE_PHPNAME, $indexType)];
            $this->locationlatitude = (null !== $col) ? (double) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : RegisteredUserTableMap::translateFieldName('Locationlongitude', TableMap::TYPE_PHPNAME, $indexType)];
            $this->locationlongitude = (null !== $col) ? (double) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : RegisteredUserTableMap::translateFieldName('Locationaccuracy', TableMap::TYPE_PHPNAME, $indexType)];
            $this->locationaccuracy = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : RegisteredUserTableMap::translateFieldName('Imei', TableMap::TYPE_PHPNAME, $indexType)];
            $this->imei = (null !== $col) ? (string) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 12; // 12 = RegisteredUserTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\RegisteredUser'), 0, $e);
        }
    }

    /**
     * Checks and repairs the internal consistency of the object.
     *
     * This method is executed after an already-instantiated object is re-hydrated
     * from the database.  It exists to check any foreign keys to make sure that
     * the objects related to the current object are correct based on foreign key.
     *
     * You can override this method in the stub class, but you should always invoke
     * the base method from the overridden method (i.e. parent::ensureConsistency()),
     * in case your model changes.
     *
     * @throws PropelException
     */
    public function ensureConsistency()
    {
    } // ensureConsistency

    /**
     * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
     *
     * This will only work if the object has been saved and has a valid primary key set.
     *
     * @param      boolean $deep (optional) Whether to also de-associated any related objects.
     * @param      ConnectionInterface $con (optional) The ConnectionInterface connection to use.
     * @return void
     * @throws PropelException - if this object is deleted, unsaved or doesn't have pk match in db
     */
    public function reload($deep = false, ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("Cannot reload a deleted object.");
        }

        if ($this->isNew()) {
            throw new PropelException("Cannot reload an unsaved object.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(RegisteredUserTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildRegisteredUserQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->collRooms = null;

            $this->collRoomUsers = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see RegisteredUser::setDeleted()
     * @see RegisteredUser::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(RegisteredUserTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildRegisteredUserQuery::create()
                ->filterByPrimaryKey($this->getPrimaryKey());
            $ret = $this->preDelete($con);
            if ($ret) {
                $deleteQuery->delete($con);
                $this->postDelete($con);
                $this->setDeleted(true);
            }
        });
    }

    /**
     * Persists this object to the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All modified related objects will also be persisted in the doSave()
     * method.  This method wraps all precipitate database operations in a
     * single transaction.
     *
     * @param      ConnectionInterface $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see doSave()
     */
    public function save(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("You cannot save an object that has been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(RegisteredUserTableMap::DATABASE_NAME);
        }

        return $con->transaction(function () use ($con) {
            $isInsert = $this->isNew();
            $ret = $this->preSave($con);
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
            } else {
                $ret = $ret && $this->preUpdate($con);
            }
            if ($ret) {
                $affectedRows = $this->doSave($con);
                if ($isInsert) {
                    $this->postInsert($con);
                } else {
                    $this->postUpdate($con);
                }
                $this->postSave($con);
                RegisteredUserTableMap::addInstanceToPool($this);
            } else {
                $affectedRows = 0;
            }

            return $affectedRows;
        });
    }

    /**
     * Performs the work of inserting or updating the row in the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All related objects are also updated in this method.
     *
     * @param      ConnectionInterface $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see save()
     */
    protected function doSave(ConnectionInterface $con)
    {
        $affectedRows = 0; // initialize var to track total num of affected rows
        if (!$this->alreadyInSave) {
            $this->alreadyInSave = true;

            if ($this->isNew() || $this->isModified()) {
                // persist changes
                if ($this->isNew()) {
                    $this->doInsert($con);
                } else {
                    $this->doUpdate($con);
                }
                $affectedRows += 1;
                $this->resetModified();
            }

            if ($this->roomsScheduledForDeletion !== null) {
                if (!$this->roomsScheduledForDeletion->isEmpty()) {
                    \RoomQuery::create()
                        ->filterByPrimaryKeys($this->roomsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->roomsScheduledForDeletion = null;
                }
            }

            if ($this->collRooms !== null) {
                foreach ($this->collRooms as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->roomUsersScheduledForDeletion !== null) {
                if (!$this->roomUsersScheduledForDeletion->isEmpty()) {
                    \RoomUserQuery::create()
                        ->filterByPrimaryKeys($this->roomUsersScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->roomUsersScheduledForDeletion = null;
                }
            }

            if ($this->collRoomUsers !== null) {
                foreach ($this->collRoomUsers as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            $this->alreadyInSave = false;

        }

        return $affectedRows;
    } // doSave()

    /**
     * Insert the row in the database.
     *
     * @param      ConnectionInterface $con
     *
     * @throws PropelException
     * @see doSave()
     */
    protected function doInsert(ConnectionInterface $con)
    {
        $modifiedColumns = array();
        $index = 0;

        $this->modifiedColumns[RegisteredUserTableMap::COL_REGISTEREDUSERID] = true;
        if (null !== $this->registereduserid) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . RegisteredUserTableMap::COL_REGISTEREDUSERID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(RegisteredUserTableMap::COL_REGISTEREDUSERID)) {
            $modifiedColumns[':p' . $index++]  = 'RegisteredUserId';
        }
        if ($this->isColumnModified(RegisteredUserTableMap::COL_EMAIL)) {
            $modifiedColumns[':p' . $index++]  = 'Email';
        }
        if ($this->isColumnModified(RegisteredUserTableMap::COL_PASSWORDHASH)) {
            $modifiedColumns[':p' . $index++]  = 'PasswordHash';
        }
        if ($this->isColumnModified(RegisteredUserTableMap::COL_ACTIVATIONKEY)) {
            $modifiedColumns[':p' . $index++]  = 'ActivationKey';
        }
        if ($this->isColumnModified(RegisteredUserTableMap::COL_REGISTEREDDATE)) {
            $modifiedColumns[':p' . $index++]  = 'RegisteredDate';
        }
        if ($this->isColumnModified(RegisteredUserTableMap::COL_ACTIVATIONDATE)) {
            $modifiedColumns[':p' . $index++]  = 'ActivationDate';
        }
        if ($this->isColumnModified(RegisteredUserTableMap::COL_ACTIVATED)) {
            $modifiedColumns[':p' . $index++]  = 'Activated';
        }
        if ($this->isColumnModified(RegisteredUserTableMap::COL_RATING)) {
            $modifiedColumns[':p' . $index++]  = 'Rating';
        }
        if ($this->isColumnModified(RegisteredUserTableMap::COL_LOCATIONLATITUDE)) {
            $modifiedColumns[':p' . $index++]  = 'LocationLatitude';
        }
        if ($this->isColumnModified(RegisteredUserTableMap::COL_LOCATIONLONGITUDE)) {
            $modifiedColumns[':p' . $index++]  = 'LocationLongitude';
        }
        if ($this->isColumnModified(RegisteredUserTableMap::COL_LOCATIONACCURACY)) {
            $modifiedColumns[':p' . $index++]  = 'LocationAccuracy';
        }
        if ($this->isColumnModified(RegisteredUserTableMap::COL_IMEI)) {
            $modifiedColumns[':p' . $index++]  = 'IMEI';
        }

        $sql = sprintf(
            'INSERT INTO RegisteredUser (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'RegisteredUserId':
                        $stmt->bindValue($identifier, $this->registereduserid, PDO::PARAM_INT);
                        break;
                    case 'Email':
                        $stmt->bindValue($identifier, $this->email, PDO::PARAM_STR);
                        break;
                    case 'PasswordHash':
                        $stmt->bindValue($identifier, $this->passwordhash, PDO::PARAM_STR);
                        break;
                    case 'ActivationKey':
                        $stmt->bindValue($identifier, $this->activationkey, PDO::PARAM_STR);
                        break;
                    case 'RegisteredDate':
                        $stmt->bindValue($identifier, $this->registereddate ? $this->registereddate->format("Y-m-d H:i:s") : null, PDO::PARAM_STR);
                        break;
                    case 'ActivationDate':
                        $stmt->bindValue($identifier, $this->activationdate ? $this->activationdate->format("Y-m-d H:i:s") : null, PDO::PARAM_STR);
                        break;
                    case 'Activated':
                        $stmt->bindValue($identifier, (int) $this->activated, PDO::PARAM_INT);
                        break;
                    case 'Rating':
                        $stmt->bindValue($identifier, $this->rating, PDO::PARAM_INT);
                        break;
                    case 'LocationLatitude':
                        $stmt->bindValue($identifier, $this->locationlatitude, PDO::PARAM_STR);
                        break;
                    case 'LocationLongitude':
                        $stmt->bindValue($identifier, $this->locationlongitude, PDO::PARAM_STR);
                        break;
                    case 'LocationAccuracy':
                        $stmt->bindValue($identifier, $this->locationaccuracy, PDO::PARAM_INT);
                        break;
                    case 'IMEI':
                        $stmt->bindValue($identifier, $this->imei, PDO::PARAM_STR);
                        break;
                }
            }
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), 0, $e);
        }

        try {
            $pk = $con->lastInsertId();
        } catch (Exception $e) {
            throw new PropelException('Unable to get autoincrement id.', 0, $e);
        }
        $this->setRegistereduserid($pk);

        $this->setNew(false);
    }

    /**
     * Update the row in the database.
     *
     * @param      ConnectionInterface $con
     *
     * @return Integer Number of updated rows
     * @see doSave()
     */
    protected function doUpdate(ConnectionInterface $con)
    {
        $selectCriteria = $this->buildPkeyCriteria();
        $valuesCriteria = $this->buildCriteria();

        return $selectCriteria->doUpdate($valuesCriteria, $con);
    }

    /**
     * Retrieves a field from the object by name passed in as a string.
     *
     * @param      string $name name
     * @param      string $type The type of fieldname the $name is of:
     *                     one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                     TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                     Defaults to TableMap::TYPE_PHPNAME.
     * @return mixed Value of field.
     */
    public function getByName($name, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = RegisteredUserTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
        $field = $this->getByPosition($pos);

        return $field;
    }

    /**
     * Retrieves a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param      int $pos position in xml schema
     * @return mixed Value of field at $pos
     */
    public function getByPosition($pos)
    {
        switch ($pos) {
            case 0:
                return $this->getRegistereduserid();
                break;
            case 1:
                return $this->getEmail();
                break;
            case 2:
                return $this->getPasswordhash();
                break;
            case 3:
                return $this->getActivationkey();
                break;
            case 4:
                return $this->getRegistereddate();
                break;
            case 5:
                return $this->getActivationdate();
                break;
            case 6:
                return $this->getActivated();
                break;
            case 7:
                return $this->getRating();
                break;
            case 8:
                return $this->getLocationlatitude();
                break;
            case 9:
                return $this->getLocationlongitude();
                break;
            case 10:
                return $this->getLocationaccuracy();
                break;
            case 11:
                return $this->getImei();
                break;
            default:
                return null;
                break;
        } // switch()
    }

    /**
     * Exports the object as an array.
     *
     * You can specify the key type of the array by passing one of the class
     * type constants.
     *
     * @param     string  $keyType (optional) One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     *                    TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                    Defaults to TableMap::TYPE_PHPNAME.
     * @param     boolean $includeLazyLoadColumns (optional) Whether to include lazy loaded columns. Defaults to TRUE.
     * @param     array $alreadyDumpedObjects List of objects to skip to avoid recursion
     * @param     boolean $includeForeignObjects (optional) Whether to include hydrated related objects. Default to FALSE.
     *
     * @return array an associative array containing the field names (as keys) and field values
     */
    public function toArray($keyType = TableMap::TYPE_PHPNAME, $includeLazyLoadColumns = true, $alreadyDumpedObjects = array(), $includeForeignObjects = false)
    {

        if (isset($alreadyDumpedObjects['RegisteredUser'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['RegisteredUser'][$this->hashCode()] = true;
        $keys = RegisteredUserTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getRegistereduserid(),
            $keys[1] => $this->getEmail(),
            $keys[2] => $this->getPasswordhash(),
            $keys[3] => $this->getActivationkey(),
            $keys[4] => $this->getRegistereddate(),
            $keys[5] => $this->getActivationdate(),
            $keys[6] => $this->getActivated(),
            $keys[7] => $this->getRating(),
            $keys[8] => $this->getLocationlatitude(),
            $keys[9] => $this->getLocationlongitude(),
            $keys[10] => $this->getLocationaccuracy(),
            $keys[11] => $this->getImei(),
        );
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->collRooms) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'rooms';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'Rooms';
                        break;
                    default:
                        $key = 'Rooms';
                }

                $result[$key] = $this->collRooms->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collRoomUsers) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'roomUsers';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'RoomUsers';
                        break;
                    default:
                        $key = 'RoomUsers';
                }

                $result[$key] = $this->collRoomUsers->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
        }

        return $result;
    }

    /**
     * Sets a field from the object by name passed in as a string.
     *
     * @param  string $name
     * @param  mixed  $value field value
     * @param  string $type The type of fieldname the $name is of:
     *                one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                Defaults to TableMap::TYPE_PHPNAME.
     * @return $this|\RegisteredUser
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = RegisteredUserTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\RegisteredUser
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setRegistereduserid($value);
                break;
            case 1:
                $this->setEmail($value);
                break;
            case 2:
                $this->setPasswordhash($value);
                break;
            case 3:
                $this->setActivationkey($value);
                break;
            case 4:
                $this->setRegistereddate($value);
                break;
            case 5:
                $this->setActivationdate($value);
                break;
            case 6:
                $this->setActivated($value);
                break;
            case 7:
                $this->setRating($value);
                break;
            case 8:
                $this->setLocationlatitude($value);
                break;
            case 9:
                $this->setLocationlongitude($value);
                break;
            case 10:
                $this->setLocationaccuracy($value);
                break;
            case 11:
                $this->setImei($value);
                break;
        } // switch()

        return $this;
    }

    /**
     * Populates the object using an array.
     *
     * This is particularly useful when populating an object from one of the
     * request arrays (e.g. $_POST).  This method goes through the column
     * names, checking to see whether a matching key exists in populated
     * array. If so the setByName() method is called for that column.
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param      array  $arr     An array to populate the object from.
     * @param      string $keyType The type of keys the array uses.
     * @return void
     */
    public function fromArray($arr, $keyType = TableMap::TYPE_PHPNAME)
    {
        $keys = RegisteredUserTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setRegistereduserid($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setEmail($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setPasswordhash($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setActivationkey($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setRegistereddate($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setActivationdate($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setActivated($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setRating($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setLocationlatitude($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setLocationlongitude($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setLocationaccuracy($arr[$keys[10]]);
        }
        if (array_key_exists($keys[11], $arr)) {
            $this->setImei($arr[$keys[11]]);
        }
    }

     /**
     * Populate the current object from a string, using a given parser format
     * <code>
     * $book = new Book();
     * $book->importFrom('JSON', '{"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * @param mixed $parser A AbstractParser instance,
     *                       or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param string $data The source data to import from
     *
     * @return $this|\RegisteredUser The current object, for fluid interface
     */
    public function importFrom($parser, $data)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        $this->fromArray($parser->toArray($data), TableMap::TYPE_PHPNAME);

        return $this;
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(RegisteredUserTableMap::DATABASE_NAME);

        if ($this->isColumnModified(RegisteredUserTableMap::COL_REGISTEREDUSERID)) {
            $criteria->add(RegisteredUserTableMap::COL_REGISTEREDUSERID, $this->registereduserid);
        }
        if ($this->isColumnModified(RegisteredUserTableMap::COL_EMAIL)) {
            $criteria->add(RegisteredUserTableMap::COL_EMAIL, $this->email);
        }
        if ($this->isColumnModified(RegisteredUserTableMap::COL_PASSWORDHASH)) {
            $criteria->add(RegisteredUserTableMap::COL_PASSWORDHASH, $this->passwordhash);
        }
        if ($this->isColumnModified(RegisteredUserTableMap::COL_ACTIVATIONKEY)) {
            $criteria->add(RegisteredUserTableMap::COL_ACTIVATIONKEY, $this->activationkey);
        }
        if ($this->isColumnModified(RegisteredUserTableMap::COL_REGISTEREDDATE)) {
            $criteria->add(RegisteredUserTableMap::COL_REGISTEREDDATE, $this->registereddate);
        }
        if ($this->isColumnModified(RegisteredUserTableMap::COL_ACTIVATIONDATE)) {
            $criteria->add(RegisteredUserTableMap::COL_ACTIVATIONDATE, $this->activationdate);
        }
        if ($this->isColumnModified(RegisteredUserTableMap::COL_ACTIVATED)) {
            $criteria->add(RegisteredUserTableMap::COL_ACTIVATED, $this->activated);
        }
        if ($this->isColumnModified(RegisteredUserTableMap::COL_RATING)) {
            $criteria->add(RegisteredUserTableMap::COL_RATING, $this->rating);
        }
        if ($this->isColumnModified(RegisteredUserTableMap::COL_LOCATIONLATITUDE)) {
            $criteria->add(RegisteredUserTableMap::COL_LOCATIONLATITUDE, $this->locationlatitude);
        }
        if ($this->isColumnModified(RegisteredUserTableMap::COL_LOCATIONLONGITUDE)) {
            $criteria->add(RegisteredUserTableMap::COL_LOCATIONLONGITUDE, $this->locationlongitude);
        }
        if ($this->isColumnModified(RegisteredUserTableMap::COL_LOCATIONACCURACY)) {
            $criteria->add(RegisteredUserTableMap::COL_LOCATIONACCURACY, $this->locationaccuracy);
        }
        if ($this->isColumnModified(RegisteredUserTableMap::COL_IMEI)) {
            $criteria->add(RegisteredUserTableMap::COL_IMEI, $this->imei);
        }

        return $criteria;
    }

    /**
     * Builds a Criteria object containing the primary key for this object.
     *
     * Unlike buildCriteria() this method includes the primary key values regardless
     * of whether or not they have been modified.
     *
     * @throws LogicException if no primary key is defined
     *
     * @return Criteria The Criteria object containing value(s) for primary key(s).
     */
    public function buildPkeyCriteria()
    {
        $criteria = ChildRegisteredUserQuery::create();
        $criteria->add(RegisteredUserTableMap::COL_REGISTEREDUSERID, $this->registereduserid);

        return $criteria;
    }

    /**
     * If the primary key is not null, return the hashcode of the
     * primary key. Otherwise, return the hash code of the object.
     *
     * @return int Hashcode
     */
    public function hashCode()
    {
        $validPk = null !== $this->getRegistereduserid();

        $validPrimaryKeyFKs = 0;
        $primaryKeyFKs = [];

        if ($validPk) {
            return crc32(json_encode($this->getPrimaryKey(), JSON_UNESCAPED_UNICODE));
        } elseif ($validPrimaryKeyFKs) {
            return crc32(json_encode($primaryKeyFKs, JSON_UNESCAPED_UNICODE));
        }

        return spl_object_hash($this);
    }

    /**
     * Returns the primary key for this object (row).
     * @return int
     */
    public function getPrimaryKey()
    {
        return $this->getRegistereduserid();
    }

    /**
     * Generic method to set the primary key (registereduserid column).
     *
     * @param       int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setRegistereduserid($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {
        return null === $this->getRegistereduserid();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param      object $copyObj An object of \RegisteredUser (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setEmail($this->getEmail());
        $copyObj->setPasswordhash($this->getPasswordhash());
        $copyObj->setActivationkey($this->getActivationkey());
        $copyObj->setRegistereddate($this->getRegistereddate());
        $copyObj->setActivationdate($this->getActivationdate());
        $copyObj->setActivated($this->getActivated());
        $copyObj->setRating($this->getRating());
        $copyObj->setLocationlatitude($this->getLocationlatitude());
        $copyObj->setLocationlongitude($this->getLocationlongitude());
        $copyObj->setLocationaccuracy($this->getLocationaccuracy());
        $copyObj->setImei($this->getImei());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getRooms() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addRoom($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getRoomUsers() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addRoomUser($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setRegistereduserid(NULL); // this is a auto-increment column, so set to default value
        }
    }

    /**
     * Makes a copy of this object that will be inserted as a new row in table when saved.
     * It creates a new object filling in the simple attributes, but skipping any primary
     * keys that are defined for the table.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param  boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @return \RegisteredUser Clone of current object.
     * @throws PropelException
     */
    public function copy($deepCopy = false)
    {
        // we use get_class(), because this might be a subclass
        $clazz = get_class($this);
        $copyObj = new $clazz();
        $this->copyInto($copyObj, $deepCopy);

        return $copyObj;
    }


    /**
     * Initializes a collection based on the name of a relation.
     * Avoids crafting an 'init[$relationName]s' method name
     * that wouldn't work when StandardEnglishPluralizer is used.
     *
     * @param      string $relationName The name of the relation to initialize
     * @return void
     */
    public function initRelation($relationName)
    {
        if ('Room' == $relationName) {
            return $this->initRooms();
        }
        if ('RoomUser' == $relationName) {
            return $this->initRoomUsers();
        }
    }

    /**
     * Clears out the collRooms collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addRooms()
     */
    public function clearRooms()
    {
        $this->collRooms = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collRooms collection loaded partially.
     */
    public function resetPartialRooms($v = true)
    {
        $this->collRoomsPartial = $v;
    }

    /**
     * Initializes the collRooms collection.
     *
     * By default this just sets the collRooms collection to an empty array (like clearcollRooms());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initRooms($overrideExisting = true)
    {
        if (null !== $this->collRooms && !$overrideExisting) {
            return;
        }
        $this->collRooms = new ObjectCollection();
        $this->collRooms->setModel('\Room');
    }

    /**
     * Gets an array of ChildRoom objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildRegisteredUser is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildRoom[] List of ChildRoom objects
     * @throws PropelException
     */
    public function getRooms(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collRoomsPartial && !$this->isNew();
        if (null === $this->collRooms || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collRooms) {
                // return empty collection
                $this->initRooms();
            } else {
                $collRooms = ChildRoomQuery::create(null, $criteria)
                    ->filterByCreator($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collRoomsPartial && count($collRooms)) {
                        $this->initRooms(false);

                        foreach ($collRooms as $obj) {
                            if (false == $this->collRooms->contains($obj)) {
                                $this->collRooms->append($obj);
                            }
                        }

                        $this->collRoomsPartial = true;
                    }

                    return $collRooms;
                }

                if ($partial && $this->collRooms) {
                    foreach ($this->collRooms as $obj) {
                        if ($obj->isNew()) {
                            $collRooms[] = $obj;
                        }
                    }
                }

                $this->collRooms = $collRooms;
                $this->collRoomsPartial = false;
            }
        }

        return $this->collRooms;
    }

    /**
     * Sets a collection of ChildRoom objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $rooms A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildRegisteredUser The current object (for fluent API support)
     */
    public function setRooms(Collection $rooms, ConnectionInterface $con = null)
    {
        /** @var ChildRoom[] $roomsToDelete */
        $roomsToDelete = $this->getRooms(new Criteria(), $con)->diff($rooms);


        //since at least one column in the foreign key is at the same time a PK
        //we can not just set a PK to NULL in the lines below. We have to store
        //a backup of all values, so we are able to manipulate these items based on the onDelete value later.
        $this->roomsScheduledForDeletion = clone $roomsToDelete;

        foreach ($roomsToDelete as $roomRemoved) {
            $roomRemoved->setCreator(null);
        }

        $this->collRooms = null;
        foreach ($rooms as $room) {
            $this->addRoom($room);
        }

        $this->collRooms = $rooms;
        $this->collRoomsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Room objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Room objects.
     * @throws PropelException
     */
    public function countRooms(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collRoomsPartial && !$this->isNew();
        if (null === $this->collRooms || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collRooms) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getRooms());
            }

            $query = ChildRoomQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByCreator($this)
                ->count($con);
        }

        return count($this->collRooms);
    }

    /**
     * Method called to associate a ChildRoom object to this object
     * through the ChildRoom foreign key attribute.
     *
     * @param  ChildRoom $l ChildRoom
     * @return $this|\RegisteredUser The current object (for fluent API support)
     */
    public function addRoom(ChildRoom $l)
    {
        if ($this->collRooms === null) {
            $this->initRooms();
            $this->collRoomsPartial = true;
        }

        if (!$this->collRooms->contains($l)) {
            $this->doAddRoom($l);
        }

        return $this;
    }

    /**
     * @param ChildRoom $room The ChildRoom object to add.
     */
    protected function doAddRoom(ChildRoom $room)
    {
        $this->collRooms[]= $room;
        $room->setCreator($this);
    }

    /**
     * @param  ChildRoom $room The ChildRoom object to remove.
     * @return $this|ChildRegisteredUser The current object (for fluent API support)
     */
    public function removeRoom(ChildRoom $room)
    {
        if ($this->getRooms()->contains($room)) {
            $pos = $this->collRooms->search($room);
            $this->collRooms->remove($pos);
            if (null === $this->roomsScheduledForDeletion) {
                $this->roomsScheduledForDeletion = clone $this->collRooms;
                $this->roomsScheduledForDeletion->clear();
            }
            $this->roomsScheduledForDeletion[]= clone $room;
            $room->setCreator(null);
        }

        return $this;
    }

    /**
     * Clears out the collRoomUsers collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addRoomUsers()
     */
    public function clearRoomUsers()
    {
        $this->collRoomUsers = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collRoomUsers collection loaded partially.
     */
    public function resetPartialRoomUsers($v = true)
    {
        $this->collRoomUsersPartial = $v;
    }

    /**
     * Initializes the collRoomUsers collection.
     *
     * By default this just sets the collRoomUsers collection to an empty array (like clearcollRoomUsers());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initRoomUsers($overrideExisting = true)
    {
        if (null !== $this->collRoomUsers && !$overrideExisting) {
            return;
        }
        $this->collRoomUsers = new ObjectCollection();
        $this->collRoomUsers->setModel('\RoomUser');
    }

    /**
     * Gets an array of ChildRoomUser objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildRegisteredUser is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildRoomUser[] List of ChildRoomUser objects
     * @throws PropelException
     */
    public function getRoomUsers(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collRoomUsersPartial && !$this->isNew();
        if (null === $this->collRoomUsers || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collRoomUsers) {
                // return empty collection
                $this->initRoomUsers();
            } else {
                $collRoomUsers = ChildRoomUserQuery::create(null, $criteria)
                    ->filterByRegisteredUser($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collRoomUsersPartial && count($collRoomUsers)) {
                        $this->initRoomUsers(false);

                        foreach ($collRoomUsers as $obj) {
                            if (false == $this->collRoomUsers->contains($obj)) {
                                $this->collRoomUsers->append($obj);
                            }
                        }

                        $this->collRoomUsersPartial = true;
                    }

                    return $collRoomUsers;
                }

                if ($partial && $this->collRoomUsers) {
                    foreach ($this->collRoomUsers as $obj) {
                        if ($obj->isNew()) {
                            $collRoomUsers[] = $obj;
                        }
                    }
                }

                $this->collRoomUsers = $collRoomUsers;
                $this->collRoomUsersPartial = false;
            }
        }

        return $this->collRoomUsers;
    }

    /**
     * Sets a collection of ChildRoomUser objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $roomUsers A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildRegisteredUser The current object (for fluent API support)
     */
    public function setRoomUsers(Collection $roomUsers, ConnectionInterface $con = null)
    {
        /** @var ChildRoomUser[] $roomUsersToDelete */
        $roomUsersToDelete = $this->getRoomUsers(new Criteria(), $con)->diff($roomUsers);


        //since at least one column in the foreign key is at the same time a PK
        //we can not just set a PK to NULL in the lines below. We have to store
        //a backup of all values, so we are able to manipulate these items based on the onDelete value later.
        $this->roomUsersScheduledForDeletion = clone $roomUsersToDelete;

        foreach ($roomUsersToDelete as $roomUserRemoved) {
            $roomUserRemoved->setRegisteredUser(null);
        }

        $this->collRoomUsers = null;
        foreach ($roomUsers as $roomUser) {
            $this->addRoomUser($roomUser);
        }

        $this->collRoomUsers = $roomUsers;
        $this->collRoomUsersPartial = false;

        return $this;
    }

    /**
     * Returns the number of related RoomUser objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related RoomUser objects.
     * @throws PropelException
     */
    public function countRoomUsers(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collRoomUsersPartial && !$this->isNew();
        if (null === $this->collRoomUsers || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collRoomUsers) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getRoomUsers());
            }

            $query = ChildRoomUserQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByRegisteredUser($this)
                ->count($con);
        }

        return count($this->collRoomUsers);
    }

    /**
     * Method called to associate a ChildRoomUser object to this object
     * through the ChildRoomUser foreign key attribute.
     *
     * @param  ChildRoomUser $l ChildRoomUser
     * @return $this|\RegisteredUser The current object (for fluent API support)
     */
    public function addRoomUser(ChildRoomUser $l)
    {
        if ($this->collRoomUsers === null) {
            $this->initRoomUsers();
            $this->collRoomUsersPartial = true;
        }

        if (!$this->collRoomUsers->contains($l)) {
            $this->doAddRoomUser($l);
        }

        return $this;
    }

    /**
     * @param ChildRoomUser $roomUser The ChildRoomUser object to add.
     */
    protected function doAddRoomUser(ChildRoomUser $roomUser)
    {
        $this->collRoomUsers[]= $roomUser;
        $roomUser->setRegisteredUser($this);
    }

    /**
     * @param  ChildRoomUser $roomUser The ChildRoomUser object to remove.
     * @return $this|ChildRegisteredUser The current object (for fluent API support)
     */
    public function removeRoomUser(ChildRoomUser $roomUser)
    {
        if ($this->getRoomUsers()->contains($roomUser)) {
            $pos = $this->collRoomUsers->search($roomUser);
            $this->collRoomUsers->remove($pos);
            if (null === $this->roomUsersScheduledForDeletion) {
                $this->roomUsersScheduledForDeletion = clone $this->collRoomUsers;
                $this->roomUsersScheduledForDeletion->clear();
            }
            $this->roomUsersScheduledForDeletion[]= clone $roomUser;
            $roomUser->setRegisteredUser(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this RegisteredUser is new, it will return
     * an empty collection; or if this RegisteredUser has previously
     * been saved, it will retrieve related RoomUsers from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in RegisteredUser.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildRoomUser[] List of ChildRoomUser objects
     */
    public function getRoomUsersJoinRoom(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildRoomUserQuery::create(null, $criteria);
        $query->joinWith('Room', $joinBehavior);

        return $this->getRoomUsers($query, $con);
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        $this->registereduserid = null;
        $this->email = null;
        $this->passwordhash = null;
        $this->activationkey = null;
        $this->registereddate = null;
        $this->activationdate = null;
        $this->activated = null;
        $this->rating = null;
        $this->locationlatitude = null;
        $this->locationlongitude = null;
        $this->locationaccuracy = null;
        $this->imei = null;
        $this->alreadyInSave = false;
        $this->clearAllReferences();
        $this->resetModified();
        $this->setNew(true);
        $this->setDeleted(false);
    }

    /**
     * Resets all references and back-references to other model objects or collections of model objects.
     *
     * This method is used to reset all php object references (not the actual reference in the database).
     * Necessary for object serialisation.
     *
     * @param      boolean $deep Whether to also clear the references on all referrer objects.
     */
    public function clearAllReferences($deep = false)
    {
        if ($deep) {
            if ($this->collRooms) {
                foreach ($this->collRooms as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collRoomUsers) {
                foreach ($this->collRoomUsers as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collRooms = null;
        $this->collRoomUsers = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(RegisteredUserTableMap::DEFAULT_STRING_FORMAT);
    }

    /**
     * Code to be run before persisting the object
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preSave(ConnectionInterface $con = null)
    {
        return true;
    }

    /**
     * Code to be run after persisting the object
     * @param ConnectionInterface $con
     */
    public function postSave(ConnectionInterface $con = null)
    {

    }

    /**
     * Code to be run before inserting to database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preInsert(ConnectionInterface $con = null)
    {
        return true;
    }

    /**
     * Code to be run after inserting to database
     * @param ConnectionInterface $con
     */
    public function postInsert(ConnectionInterface $con = null)
    {

    }

    /**
     * Code to be run before updating the object in database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preUpdate(ConnectionInterface $con = null)
    {
        return true;
    }

    /**
     * Code to be run after updating the object in database
     * @param ConnectionInterface $con
     */
    public function postUpdate(ConnectionInterface $con = null)
    {

    }

    /**
     * Code to be run before deleting the object in database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preDelete(ConnectionInterface $con = null)
    {
        return true;
    }

    /**
     * Code to be run after deleting the object in database
     * @param ConnectionInterface $con
     */
    public function postDelete(ConnectionInterface $con = null)
    {

    }


    /**
     * Derived method to catches calls to undefined methods.
     *
     * Provides magic import/export method support (fromXML()/toXML(), fromYAML()/toYAML(), etc.).
     * Allows to define default __call() behavior if you overwrite __call()
     *
     * @param string $name
     * @param mixed  $params
     *
     * @return array|string
     */
    public function __call($name, $params)
    {
        if (0 === strpos($name, 'get')) {
            $virtualColumn = substr($name, 3);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }

            $virtualColumn = lcfirst($virtualColumn);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }
        }

        if (0 === strpos($name, 'from')) {
            $format = substr($name, 4);

            return $this->importFrom($format, reset($params));
        }

        if (0 === strpos($name, 'to')) {
            $format = substr($name, 2);
            $includeLazyLoadColumns = isset($params[0]) ? $params[0] : true;

            return $this->exportTo($format, $includeLazyLoadColumns);
        }

        throw new BadMethodCallException(sprintf('Call to undefined method: %s.', $name));
    }

}
