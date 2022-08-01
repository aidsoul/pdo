
<a  href="https://github.com/aidsoul/pdo/releases/latest"  title="GitHub release">
<img  src="https://img.shields.io/github/v/release/aidsoul/pdo">
</a>

## PDO query builder

## Installation

Installation with the command:
```
composer require aidsoul/pdo
```
## Example Usage
```php
require_once  __DIR__  .  '/vendor/autoload.php';
use Aidsoul\Pdo\Db;

$host  =  'localhost';
$dbName  =  'test';
$user  =  'root';
$pass  =  '';

$db  =  new  Db("mysql:host={$host};dbname={$dbName}",  $user,  $pass);

// SELECT
$db->select()
->from('post')
->join('vkgroup')->on('group_id','id_group')
->orderBy(['id_post'  =>'ASC'])
->limit(50)
->execute()
->fetchAll();

// INSERT
$db->insert(['id_post','group_id'])
->into('post')
->values([66,28])
->execute();

// DELETE
$db->delete()
->from('post')
->where('group_id','=',113)->and('id_post','=',147)
->execute();

// UPDATE
$db->update('vkgroup')
->set(['name'=>'test'])
->where('id_group','=',111)
->and('name','=','before the test')
->execute();

```
 

