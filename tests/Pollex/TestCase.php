<?php
namespace Pollex\Tests;

abstract class TestCase extends PHPUnit_Framework_TestCase
{
    /**
     * mock object for Doctrine's entityManager
     *
     * @var PHPUnit_Framework_MockObject
     */
    protected $_mockEntityManager;

    /**
     * mock object for Doctrine's Repository
     *
     * @var PHPUnit_Framework_MockObject
     */
    protected $_mockRepository;

    /**
     * setup testing environment and create common mock objects
     *
     * @return void
     */
    protected function setUp()
    {
        parent::setUp();

        $this->_mockRepository = $this->_getRepositoryMock();
        $this->_mockEntityManager = $this->_getEntityManagerMock();
    }

    /**
     * create an entity manager mock object
     *
     * @return PHPUnit_Framework_MockObject
     */
    protected function _getEntityManagerMock()
    {
        if (NULL === $this->_mockEntityManager) {
            $mock = $this->getMock(
                'EntityManagerMock',
                array(
                    'getRepository',
                    'persist',
                    'flush',
                    'find',
                    'findBy',
                    'findOneBy',
                    'remove',
                    'transactional',
                    'clear',
                )
            );

            $mock->expects($this->any())
                 ->method('getRepository')
                 ->will($this->returnValue($this->_getRepositoryMock()));

            // provides a fluent interface to the method 'persist'
            $mock->expects($this->any())
                 ->method('persist')
                 ->will($this->returnValue($mock));

            $mock->expects($this->any())
                 ->method('flush')
                 ->will($this->returnValue($mock));

            // configure mock find method to simply call Repository::find()
            $mock->expects($this->any())
                 ->method('find')
                 ->will($this->returnCallback(array($this->_getRepositoryMock(), 'find')));
        } else {
            $mock = $this->_mockEntityManager;
        }

        return $mock;
    }

    /**
     * create a mock object for the repository
     *
     * @return PHPUnit_Framework_MockObject
     */
    protected function _getRepositoryMock()
    {
        if (NULL === $this->_mockRepository) {
            $repositoryMock = $this->getMock(
                'EntityRepositoryMock',
                array(
                     'find',
                     'findAll',
                     'findBy',
                     'findOneBy',
                     'findOneByCode',
                     'findOneByName',
                     'findOneByNumber',
                     'findOneByObiNumber',
                )
            );
        } else {
            $repositoryMock = $this->_mockRepository;
        }

        return $repositoryMock;
    }

    /**
     * @param string $name
     * @param Obi_Entity_Abstract $entity
     * @return PHPUnit_Framework_MockObject
     */
    protected function _mockRepositoryMethod($name, $entity)
    {
        $em = $this->_getEntityManagerMock();
        $em->getRepository()
            ->expects($this->any())
            ->method($name)
            ->will($this->returnValue($entity));

        return $em;
    }

    /**
     * get a temp file name to use for the tests
     *
     * @return string
     */
    protected function _getTempDir()
    {
        return join(
            DIRECTORY_SEPARATOR,
            array(
                sys_get_temp_dir(),
                get_class($this),
            )
        );
    }
}