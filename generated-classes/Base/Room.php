<?php

namespace Base;

use \Message as ChildMessage;
use \MessageQuery as ChildMessageQuery;
use \RegisteredUser as ChildRegisteredUser;
use \RegisteredUserQuery as ChildRegisteredUserQuery;
use \Room as ChildRoom;
use \RoomQuery as ChildRoomQuery;
use \RoomUser as ChildRoomUser;
use \RoomUserQuery as ChildRoomUserQuery;
use \DateTime;
use \Exception;
use \PDO;
use Map\RoomTableMap;
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
 * Base class that represents a row from the 'Room' table.
 *
 *
 *
* @package    propel.generator..Base
*/
abstract class Room implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\Map\\RoomTableMap';


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
     * The value for the roomid field.
     * @var        int
     */
    protected $roomid;

    /**
     * The value for the createddate field.
     * @var        \DateTime
     */
    protected $createddate;

    /**
     * The value for the timeout field.
     * @var        \DateTime
     */
    protected $timeout;

    /**
     * The value for the roomusersid field.
     * @var        int
     */
    protected $roomusersid;

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
     * @var        ObjectCollection|ChildMessage[] Collection to store aggregation of ChildMessage objects.
     */
    protected $collMessages;
    protected $collMessagesPartial;

    /**
     * @var        ObjectCollection|ChildRoomUser[] Collection to store aggregation of ChildRoomUser objects.
     */
    protected $collRoomUsers;
    protected $collRoomUsersPartial;

    /**
     * @var        ObjectCollection|ChildRegisteredUser[] Cross Collection to store aggregation of ChildRegisteredUser objects.
     */
    protected $collRegisteredUsers;

    /**
     * @var bool
     */
    protected $collRegisteredUsersPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildRegisteredUser[]
     */
    protected $registeredUsersScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildMessage[]
     */
    protected $messagesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildRoomUser[]
     */
    protected $roomUsersScheduledForDeletion = null;

    /**
     * Initializes internal state of Base\Room object.
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
     * Compares this with another <code>Room</code> instance.  If
     * <code>obj</code> is an instance of <code>Room</code>, delegates to
     * <code>equals(Room)</code>.  Otherwise, returns <code>false</code>.
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
     * @return $this|Room The current object, for fluid interface
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
     * Get the [roomid] column value.
     *
     * @return int
     */
    public function getRoomid()
    {
        return $this->roomid;
    }

    /**
     * Get the [optionally formatted] temporal [createddate] column value.
     *
     *
     * @param      string $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getCreateddate($format = NULL)
    {
        if ($format === null) {
            return $this->createddate;
        } else {
            return $this->createddate instanceof \DateTime ? $this->createddate->format($format) : null;
        }
    }

    /**
     * Get the [optionally formatted] temporal [timeout] column value.
     *
     *
     * @param      string $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getTimeout($format = NULL)
    {
        if ($format === null) {
            return $this->timeout;
        } else {
            return $this->timeout instanceof \DateTime ? $this->timeout->format($format) : null;
        }
    }

    /**
     * Get the [roomusersid] column value.
     *
     * @return int
     */
    public function getRoomusersid()
    {
        return $this->roomusersid;
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
     * Set the value of [roomid] column.
     *
     * @param  int $v new value
     * @return $this|\Room The current object (for fluent API support)
     */
    public function setRoomid($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->roomid !== $v) {
            $this->roomid = $v;
            $this->modifiedColumns[RoomTableMap::COL_ROOMID] = true;
        }

        return $this;
    } // setRoomid()

    /**
     * Sets the value of [createddate] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTime value.
     *               Empty strings are treated as NULL.
     * @return $this|\Room The current object (for fluent API support)
     */
    public function setCreateddate($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->createddate !== null || $dt !== null) {
            if ($dt !== $this->createddate) {
                $this->createddate = $dt;
                $this->modifiedColumns[RoomTableMap::COL_CREATEDDATE] = true;
            }
        } // if either are not null

        return $this;
    } // setCreateddate()

    /**
     * Sets the value of [timeout] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTime value.
     *               Empty strings are treated as NULL.
     * @return $this|\Room The current object (for fluent API support)
     */
    public function setTimeout($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->timeout !== null || $dt !== null) {
            if ($dt !== $this->timeout) {
                $this->timeout = $dt;
                $this->modifiedColumns[RoomTableMap::COL_TIMEOUT] = true;
            }
        } // if either are not null

        return $this;
    } // setTimeout()

    /**
     * Set the value of [roomusersid] column.
     *
     * @param  int $v new value
     * @return $this|\Room The current object (for fluent API support)
     */
    public function setRoomusersid($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->roomusersid !== $v) {
            $this->roomusersid = $v;
            $this->modifiedColumns[RoomTableMap::COL_ROOMUSERSID] = true;
        }

        return $this;
    } // setRoomusersid()

    /**
     * Set the value of [rating] column.
     *
     * @param  int $v new value
     * @return $this|\Room The current object (for fluent API support)
     */
    public function setRating($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->rating !== $v) {
            $this->rating = $v;
            $this->modifiedColumns[RoomTableMap::COL_RATING] = true;
        }

        return $this;
    } // setRating()

    /**
     * Set the value of [locationlatitude] column.
     *
     * @param  double $v new value
     * @return $this|\Room The current object (for fluent API support)
     */
    public function setLocationlatitude($v)
    {
        if ($v !== null) {
            $v = (double) $v;
        }

        if ($this->locationlatitude !== $v) {
            $this->locationlatitude = $v;
            $this->modifiedColumns[RoomTableMap::COL_LOCATIONLATITUDE] = true;
        }

        return $this;
    } // setLocationlatitude()

    /**
     * Set the value of [locationlongitude] column.
     *
     * @param  double $v new value
     * @return $this|\Room The current object (for fluent API support)
     */
    public function setLocationlongitude($v)
    {
        if ($v !== null) {
            $v = (double) $v;
        }

        if ($this->locationlongitude !== $v) {
            $this->locationlongitude = $v;
            $this->modifiedColumns[RoomTableMap::COL_LOCATIONLONGITUDE] = true;
        }

        return $this;
    } // setLocationlongitude()

    /**
     * Set the value of [locationaccuracy] column.
     *
     * @param  int $v new value
     * @return $this|\Room The current object (for fluent API support)
     */
    public function setLocationaccuracy($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->locationaccuracy !== $v) {
            $this->locationaccuracy = $v;
            $this->modifiedColumns[RoomTableMap::COL_LOCATIONACCURACY] = true;
        }

        return $this;
    } // setLocationaccuracy()

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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : RoomTableMap::translateFieldName('Roomid', TableMap::TYPE_PHPNAME, $indexType)];
            $this->roomid = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : RoomTableMap::translateFieldName('Createddate', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->createddate = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : RoomTableMap::translateFieldName('Timeout', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->timeout = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : RoomTableMap::translateFieldName('Roomusersid', TableMap::TYPE_PHPNAME, $indexType)];
            $this->roomusersid = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : RoomTableMap::translateFieldName('Rating', TableMap::TYPE_PHPNAME, $indexType)];
            $this->rating = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : RoomTableMap::translateFieldName('Locationlatitude', TableMap::TYPE_PHPNAME, $indexType)];
            $this->locationlatitude = (null !== $col) ? (double) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : RoomTableMap::translateFieldName('Locationlongitude', TableMap::TYPE_PHPNAME, $indexType)];
            $this->locationlongitude = (null !== $col) ? (double) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : RoomTableMap::translateFieldName('Locationaccuracy', TableMap::TYPE_PHPNAME, $indexType)];
            $this->locationaccuracy = (null !== $col) ? (int) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 8; // 8 = RoomTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\Room'), 0, $e);
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
            $con = Propel::getServiceContainer()->getReadConnection(RoomTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildRoomQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->collMessages = null;

            $this->collRoomUsers = null;

            $this->collRegisteredUsers = null;
        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see Room::setDeleted()
     * @see Room::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(RoomTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildRoomQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(RoomTableMap::DATABASE_NAME);
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
                RoomTableMap::addInstanceToPool($this);
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

            if ($this->registeredUsersScheduledForDeletion !== null) {
                if (!$this->registeredUsersScheduledForDeletion->isEmpty()) {
                    $pks = array();
                    foreach ($this->registeredUsersScheduledForDeletion as $entry) {
                        $entryPk = [];

                        $entryPk[1] = $this->getRoomid();
                        $entryPk[0] = $entry->getRegistereduserid();
                        $pks[] = $entryPk;
                    }

                    \RoomUserQuery::create()
                        ->filterByPrimaryKeys($pks)
                        ->delete($con);

                    $this->registeredUsersScheduledForDeletion = null;
                }

            }

            if ($this->collRegisteredUsers) {
                foreach ($this->collRegisteredUsers as $registeredUser) {
                    if (!$registeredUser->isDeleted() && ($registeredUser->isNew() || $registeredUser->isModified())) {
                        $registeredUser->save($con);
                    }
                }
            }


            if ($this->messagesScheduledForDeletion !== null) {
                if (!$this->messagesScheduledForDeletion->isEmpty()) {
                    \MessageQuery::create()
                        ->filterByPrimaryKeys($this->messagesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->messagesScheduledForDeletion = null;
                }
            }

            if ($this->collMessages !== null) {
                foreach ($this->collMessages as $referrerFK) {
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

        $this->modifiedColumns[RoomTableMap::COL_ROOMID] = true;
        if (null !== $this->roomid) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . RoomTableMap::COL_ROOMID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(RoomTableMap::COL_ROOMID)) {
            $modifiedColumns[':p' . $index++]  = 'RoomId';
        }
        if ($this->isColumnModified(RoomTableMap::COL_CREATEDDATE)) {
            $modifiedColumns[':p' . $index++]  = 'CreatedDate';
        }
        if ($this->isColumnModified(RoomTableMap::COL_TIMEOUT)) {
            $modifiedColumns[':p' . $index++]  = 'Timeout';
        }
        if ($this->isColumnModified(RoomTableMap::COL_ROOMUSERSID)) {
            $modifiedColumns[':p' . $index++]  = 'RoomUsersId';
        }
        if ($this->isColumnModified(RoomTableMap::COL_RATING)) {
            $modifiedColumns[':p' . $index++]  = 'Rating';
        }
        if ($this->isColumnModified(RoomTableMap::COL_LOCATIONLATITUDE)) {
            $modifiedColumns[':p' . $index++]  = 'LocationLatitude';
        }
        if ($this->isColumnModified(RoomTableMap::COL_LOCATIONLONGITUDE)) {
            $modifiedColumns[':p' . $index++]  = 'LocationLongitude';
        }
        if ($this->isColumnModified(RoomTableMap::COL_LOCATIONACCURACY)) {
            $modifiedColumns[':p' . $index++]  = 'LocationAccuracy';
        }

        $sql = sprintf(
            'INSERT INTO Room (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'RoomId':
                        $stmt->bindValue($identifier, $this->roomid, PDO::PARAM_INT);
                        break;
                    case 'CreatedDate':
                        $stmt->bindValue($identifier, $this->createddate ? $this->createddate->format("Y-m-d H:i:s") : null, PDO::PARAM_STR);
                        break;
                    case 'Timeout':
                        $stmt->bindValue($identifier, $this->timeout ? $this->timeout->format("Y-m-d H:i:s") : null, PDO::PARAM_STR);
                        break;
                    case 'RoomUsersId':
                        $stmt->bindValue($identifier, $this->roomusersid, PDO::PARAM_INT);
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
        $this->setRoomid($pk);

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
        $pos = RoomTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getRoomid();
                break;
            case 1:
                return $this->getCreateddate();
                break;
            case 2:
                return $this->getTimeout();
                break;
            case 3:
                return $this->getRoomusersid();
                break;
            case 4:
                return $this->getRating();
                break;
            case 5:
                return $this->getLocationlatitude();
                break;
            case 6:
                return $this->getLocationlongitude();
                break;
            case 7:
                return $this->getLocationaccuracy();
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

        if (isset($alreadyDumpedObjects['Room'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Room'][$this->hashCode()] = true;
        $keys = RoomTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getRoomid(),
            $keys[1] => $this->getCreateddate(),
            $keys[2] => $this->getTimeout(),
            $keys[3] => $this->getRoomusersid(),
            $keys[4] => $this->getRating(),
            $keys[5] => $this->getLocationlatitude(),
            $keys[6] => $this->getLocationlongitude(),
            $keys[7] => $this->getLocationaccuracy(),
        );
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->collMessages) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'messages';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'Messages';
                        break;
                    default:
                        $key = 'Messages';
                }

                $result[$key] = $this->collMessages->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
     * @return $this|\Room
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = RoomTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\Room
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setRoomid($value);
                break;
            case 1:
                $this->setCreateddate($value);
                break;
            case 2:
                $this->setTimeout($value);
                break;
            case 3:
                $this->setRoomusersid($value);
                break;
            case 4:
                $this->setRating($value);
                break;
            case 5:
                $this->setLocationlatitude($value);
                break;
            case 6:
                $this->setLocationlongitude($value);
                break;
            case 7:
                $this->setLocationaccuracy($value);
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
        $keys = RoomTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setRoomid($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setCreateddate($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setTimeout($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setRoomusersid($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setRating($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setLocationlatitude($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setLocationlongitude($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setLocationaccuracy($arr[$keys[7]]);
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
     * @return $this|\Room The current object, for fluid interface
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
        $criteria = new Criteria(RoomTableMap::DATABASE_NAME);

        if ($this->isColumnModified(RoomTableMap::COL_ROOMID)) {
            $criteria->add(RoomTableMap::COL_ROOMID, $this->roomid);
        }
        if ($this->isColumnModified(RoomTableMap::COL_CREATEDDATE)) {
            $criteria->add(RoomTableMap::COL_CREATEDDATE, $this->createddate);
        }
        if ($this->isColumnModified(RoomTableMap::COL_TIMEOUT)) {
            $criteria->add(RoomTableMap::COL_TIMEOUT, $this->timeout);
        }
        if ($this->isColumnModified(RoomTableMap::COL_ROOMUSERSID)) {
            $criteria->add(RoomTableMap::COL_ROOMUSERSID, $this->roomusersid);
        }
        if ($this->isColumnModified(RoomTableMap::COL_RATING)) {
            $criteria->add(RoomTableMap::COL_RATING, $this->rating);
        }
        if ($this->isColumnModified(RoomTableMap::COL_LOCATIONLATITUDE)) {
            $criteria->add(RoomTableMap::COL_LOCATIONLATITUDE, $this->locationlatitude);
        }
        if ($this->isColumnModified(RoomTableMap::COL_LOCATIONLONGITUDE)) {
            $criteria->add(RoomTableMap::COL_LOCATIONLONGITUDE, $this->locationlongitude);
        }
        if ($this->isColumnModified(RoomTableMap::COL_LOCATIONACCURACY)) {
            $criteria->add(RoomTableMap::COL_LOCATIONACCURACY, $this->locationaccuracy);
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
        $criteria = ChildRoomQuery::create();
        $criteria->add(RoomTableMap::COL_ROOMID, $this->roomid);

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
        $validPk = null !== $this->getRoomid();

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
        return $this->getRoomid();
    }

    /**
     * Generic method to set the primary key (roomid column).
     *
     * @param       int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setRoomid($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {
        return null === $this->getRoomid();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param      object $copyObj An object of \Room (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setCreateddate($this->getCreateddate());
        $copyObj->setTimeout($this->getTimeout());
        $copyObj->setRoomusersid($this->getRoomusersid());
        $copyObj->setRating($this->getRating());
        $copyObj->setLocationlatitude($this->getLocationlatitude());
        $copyObj->setLocationlongitude($this->getLocationlongitude());
        $copyObj->setLocationaccuracy($this->getLocationaccuracy());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getMessages() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addMessage($relObj->copy($deepCopy));
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
            $copyObj->setRoomid(NULL); // this is a auto-increment column, so set to default value
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
     * @return \Room Clone of current object.
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
        if ('Message' == $relationName) {
            return $this->initMessages();
        }
        if ('RoomUser' == $relationName) {
            return $this->initRoomUsers();
        }
    }

    /**
     * Clears out the collMessages collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addMessages()
     */
    public function clearMessages()
    {
        $this->collMessages = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collMessages collection loaded partially.
     */
    public function resetPartialMessages($v = true)
    {
        $this->collMessagesPartial = $v;
    }

    /**
     * Initializes the collMessages collection.
     *
     * By default this just sets the collMessages collection to an empty array (like clearcollMessages());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initMessages($overrideExisting = true)
    {
        if (null !== $this->collMessages && !$overrideExisting) {
            return;
        }
        $this->collMessages = new ObjectCollection();
        $this->collMessages->setModel('\Message');
    }

    /**
     * Gets an array of ChildMessage objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildRoom is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildMessage[] List of ChildMessage objects
     * @throws PropelException
     */
    public function getMessages(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collMessagesPartial && !$this->isNew();
        if (null === $this->collMessages || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collMessages) {
                // return empty collection
                $this->initMessages();
            } else {
                $collMessages = ChildMessageQuery::create(null, $criteria)
                    ->filterByRoom($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collMessagesPartial && count($collMessages)) {
                        $this->initMessages(false);

                        foreach ($collMessages as $obj) {
                            if (false == $this->collMessages->contains($obj)) {
                                $this->collMessages->append($obj);
                            }
                        }

                        $this->collMessagesPartial = true;
                    }

                    return $collMessages;
                }

                if ($partial && $this->collMessages) {
                    foreach ($this->collMessages as $obj) {
                        if ($obj->isNew()) {
                            $collMessages[] = $obj;
                        }
                    }
                }

                $this->collMessages = $collMessages;
                $this->collMessagesPartial = false;
            }
        }

        return $this->collMessages;
    }

    /**
     * Sets a collection of ChildMessage objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $messages A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildRoom The current object (for fluent API support)
     */
    public function setMessages(Collection $messages, ConnectionInterface $con = null)
    {
        /** @var ChildMessage[] $messagesToDelete */
        $messagesToDelete = $this->getMessages(new Criteria(), $con)->diff($messages);


        $this->messagesScheduledForDeletion = $messagesToDelete;

        foreach ($messagesToDelete as $messageRemoved) {
            $messageRemoved->setRoom(null);
        }

        $this->collMessages = null;
        foreach ($messages as $message) {
            $this->addMessage($message);
        }

        $this->collMessages = $messages;
        $this->collMessagesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Message objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Message objects.
     * @throws PropelException
     */
    public function countMessages(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collMessagesPartial && !$this->isNew();
        if (null === $this->collMessages || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collMessages) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getMessages());
            }

            $query = ChildMessageQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByRoom($this)
                ->count($con);
        }

        return count($this->collMessages);
    }

    /**
     * Method called to associate a ChildMessage object to this object
     * through the ChildMessage foreign key attribute.
     *
     * @param  ChildMessage $l ChildMessage
     * @return $this|\Room The current object (for fluent API support)
     */
    public function addMessage(ChildMessage $l)
    {
        if ($this->collMessages === null) {
            $this->initMessages();
            $this->collMessagesPartial = true;
        }

        if (!$this->collMessages->contains($l)) {
            $this->doAddMessage($l);
        }

        return $this;
    }

    /**
     * @param ChildMessage $message The ChildMessage object to add.
     */
    protected function doAddMessage(ChildMessage $message)
    {
        $this->collMessages[]= $message;
        $message->setRoom($this);
    }

    /**
     * @param  ChildMessage $message The ChildMessage object to remove.
     * @return $this|ChildRoom The current object (for fluent API support)
     */
    public function removeMessage(ChildMessage $message)
    {
        if ($this->getMessages()->contains($message)) {
            $pos = $this->collMessages->search($message);
            $this->collMessages->remove($pos);
            if (null === $this->messagesScheduledForDeletion) {
                $this->messagesScheduledForDeletion = clone $this->collMessages;
                $this->messagesScheduledForDeletion->clear();
            }
            $this->messagesScheduledForDeletion[]= clone $message;
            $message->setRoom(null);
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
     * If this ChildRoom is new, it will return
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
                    ->filterByRoom($this)
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
     * @return $this|ChildRoom The current object (for fluent API support)
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
            $roomUserRemoved->setRoom(null);
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
                ->filterByRoom($this)
                ->count($con);
        }

        return count($this->collRoomUsers);
    }

    /**
     * Method called to associate a ChildRoomUser object to this object
     * through the ChildRoomUser foreign key attribute.
     *
     * @param  ChildRoomUser $l ChildRoomUser
     * @return $this|\Room The current object (for fluent API support)
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
        $roomUser->setRoom($this);
    }

    /**
     * @param  ChildRoomUser $roomUser The ChildRoomUser object to remove.
     * @return $this|ChildRoom The current object (for fluent API support)
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
            $roomUser->setRoom(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Room is new, it will return
     * an empty collection; or if this Room has previously
     * been saved, it will retrieve related RoomUsers from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Room.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildRoomUser[] List of ChildRoomUser objects
     */
    public function getRoomUsersJoinRegisteredUser(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildRoomUserQuery::create(null, $criteria);
        $query->joinWith('RegisteredUser', $joinBehavior);

        return $this->getRoomUsers($query, $con);
    }

    /**
     * Clears out the collRegisteredUsers collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addRegisteredUsers()
     */
    public function clearRegisteredUsers()
    {
        $this->collRegisteredUsers = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Initializes the collRegisteredUsers crossRef collection.
     *
     * By default this just sets the collRegisteredUsers collection to an empty collection (like clearRegisteredUsers());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @return void
     */
    public function initRegisteredUsers()
    {
        $this->collRegisteredUsers = new ObjectCollection();
        $this->collRegisteredUsersPartial = true;

        $this->collRegisteredUsers->setModel('\RegisteredUser');
    }

    /**
     * Checks if the collRegisteredUsers collection is loaded.
     *
     * @return bool
     */
    public function isRegisteredUsersLoaded()
    {
        return null !== $this->collRegisteredUsers;
    }

    /**
     * Gets a collection of ChildRegisteredUser objects related by a many-to-many relationship
     * to the current object by way of the RoomUser cross-reference table.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildRoom is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria Optional query object to filter the query
     * @param      ConnectionInterface $con Optional connection object
     *
     * @return ObjectCollection|ChildRegisteredUser[] List of ChildRegisteredUser objects
     */
    public function getRegisteredUsers(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collRegisteredUsersPartial && !$this->isNew();
        if (null === $this->collRegisteredUsers || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collRegisteredUsers) {
                    $this->initRegisteredUsers();
                }
            } else {

                $query = ChildRegisteredUserQuery::create(null, $criteria)
                    ->filterByRoom($this);
                $collRegisteredUsers = $query->find($con);
                if (null !== $criteria) {
                    return $collRegisteredUsers;
                }

                if ($partial && $this->collRegisteredUsers) {
                    //make sure that already added objects gets added to the list of the database.
                    foreach ($this->collRegisteredUsers as $obj) {
                        if (!$collRegisteredUsers->contains($obj)) {
                            $collRegisteredUsers[] = $obj;
                        }
                    }
                }

                $this->collRegisteredUsers = $collRegisteredUsers;
                $this->collRegisteredUsersPartial = false;
            }
        }

        return $this->collRegisteredUsers;
    }

    /**
     * Sets a collection of RegisteredUser objects related by a many-to-many relationship
     * to the current object by way of the RoomUser cross-reference table.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param  Collection $registeredUsers A Propel collection.
     * @param  ConnectionInterface $con Optional connection object
     * @return $this|ChildRoom The current object (for fluent API support)
     */
    public function setRegisteredUsers(Collection $registeredUsers, ConnectionInterface $con = null)
    {
        $this->clearRegisteredUsers();
        $currentRegisteredUsers = $this->getRegisteredUsers();

        $registeredUsersScheduledForDeletion = $currentRegisteredUsers->diff($registeredUsers);

        foreach ($registeredUsersScheduledForDeletion as $toDelete) {
            $this->removeRegisteredUser($toDelete);
        }

        foreach ($registeredUsers as $registeredUser) {
            if (!$currentRegisteredUsers->contains($registeredUser)) {
                $this->doAddRegisteredUser($registeredUser);
            }
        }

        $this->collRegisteredUsersPartial = false;
        $this->collRegisteredUsers = $registeredUsers;

        return $this;
    }

    /**
     * Gets the number of RegisteredUser objects related by a many-to-many relationship
     * to the current object by way of the RoomUser cross-reference table.
     *
     * @param      Criteria $criteria Optional query object to filter the query
     * @param      boolean $distinct Set to true to force count distinct
     * @param      ConnectionInterface $con Optional connection object
     *
     * @return int the number of related RegisteredUser objects
     */
    public function countRegisteredUsers(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collRegisteredUsersPartial && !$this->isNew();
        if (null === $this->collRegisteredUsers || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collRegisteredUsers) {
                return 0;
            } else {

                if ($partial && !$criteria) {
                    return count($this->getRegisteredUsers());
                }

                $query = ChildRegisteredUserQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByRoom($this)
                    ->count($con);
            }
        } else {
            return count($this->collRegisteredUsers);
        }
    }

    /**
     * Associate a ChildRegisteredUser to this object
     * through the RoomUser cross reference table.
     *
     * @param ChildRegisteredUser $registeredUser
     * @return ChildRoom The current object (for fluent API support)
     */
    public function addRegisteredUser(ChildRegisteredUser $registeredUser)
    {
        if ($this->collRegisteredUsers === null) {
            $this->initRegisteredUsers();
        }

        if (!$this->getRegisteredUsers()->contains($registeredUser)) {
            // only add it if the **same** object is not already associated
            $this->collRegisteredUsers->push($registeredUser);
            $this->doAddRegisteredUser($registeredUser);
        }

        return $this;
    }

    /**
     *
     * @param ChildRegisteredUser $registeredUser
     */
    protected function doAddRegisteredUser(ChildRegisteredUser $registeredUser)
    {
        $roomUser = new ChildRoomUser();

        $roomUser->setRegisteredUser($registeredUser);

        $roomUser->setRoom($this);

        $this->addRoomUser($roomUser);

        // set the back reference to this object directly as using provided method either results
        // in endless loop or in multiple relations
        if (!$registeredUser->isRoomsLoaded()) {
            $registeredUser->initRooms();
            $registeredUser->getRooms()->push($this);
        } elseif (!$registeredUser->getRooms()->contains($this)) {
            $registeredUser->getRooms()->push($this);
        }

    }

    /**
     * Remove registeredUser of this object
     * through the RoomUser cross reference table.
     *
     * @param ChildRegisteredUser $registeredUser
     * @return ChildRoom The current object (for fluent API support)
     */
    public function removeRegisteredUser(ChildRegisteredUser $registeredUser)
    {
        if ($this->getRegisteredUsers()->contains($registeredUser)) { $roomUser = new ChildRoomUser();

            $roomUser->setRegisteredUser($registeredUser);
            if ($registeredUser->isRoomsLoaded()) {
                //remove the back reference if available
                $registeredUser->getRooms()->removeObject($this);
            }

            $roomUser->setRoom($this);
            $this->removeRoomUser(clone $roomUser);
            $roomUser->clear();

            $this->collRegisteredUsers->remove($this->collRegisteredUsers->search($registeredUser));

            if (null === $this->registeredUsersScheduledForDeletion) {
                $this->registeredUsersScheduledForDeletion = clone $this->collRegisteredUsers;
                $this->registeredUsersScheduledForDeletion->clear();
            }

            $this->registeredUsersScheduledForDeletion->push($registeredUser);
        }


        return $this;
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        $this->roomid = null;
        $this->createddate = null;
        $this->timeout = null;
        $this->roomusersid = null;
        $this->rating = null;
        $this->locationlatitude = null;
        $this->locationlongitude = null;
        $this->locationaccuracy = null;
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
            if ($this->collMessages) {
                foreach ($this->collMessages as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collRoomUsers) {
                foreach ($this->collRoomUsers as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collRegisteredUsers) {
                foreach ($this->collRegisteredUsers as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collMessages = null;
        $this->collRoomUsers = null;
        $this->collRegisteredUsers = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(RoomTableMap::DEFAULT_STRING_FORMAT);
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
