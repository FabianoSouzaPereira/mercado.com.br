<?php
namespace modules\studentbody;

use PDO;
use modules\Person;

class Student extends Person
{
     private $stuenrolment;
     private $stuname;
     private $stuage;
     private $stuaddress;
     private $stuneighborhood;
     private $stucity;
     private $stustate;
     private $stucountry;
     private $stuzipcode;
     private $stusponsor;
    
    /** Function does a post into studant. */
    public function post()
    {
       $sql ="INSERT INTO `studant`(`stuenrolment`, 
                 `stuname`, 
                 `stuage`, 
                 `stuaddress`, 
                 `stuneighborhood`, 
                 `stucity`, 
                 `stustate`, 
                 `stucountry`, 
                 `stuzipcode`, 
                 `stusponsor`) 
                VALUES (:stuenrolment, 
                  :stuname, 
                  :stuage, 
                  :stuaddress, 
                  :stuneighborhood, 
                  :stucity, 
                  :stustate, 
                  :stucountry, 
                  :stuzipcode, 
                  :stusponsor)";
        
        $stmt = $pdo->prepare($sql);
        
        $stmt->bindParam(':stuname', $_POST['stuname'], PDO::PARAM_STR);
        $stmt->bindParam(':stuage', $_POST['stuage'], PDO::PARAM_STR);
        $stmt->bindParam(':stuaddress', $_POST['stuaddress'], PDO::PARAM_STR);
        $stmt->bindParam(':stuneighborhood', $_POST['stuneighborhood'], PDO::PARAM_STR);
        $stmt->bindParam(':stucity', $_POST['stucity'], PDO::PARAM_STR);
        $stmt->bindParam(':stustate', $_POST['stustate'], PDO::PARAM_STR);
        $stmt->bindParam(':stucountry', $_POST['stucountry'], PDO::PARAM_STR);
        $stmt->bindParam(':stuzipcode', $_POST['stuzipcode'], PDO::PARAM_STR);
        $stmt->bindParam(':stusponsor', $_POST['stusponsor'], PDO::PARAM_STR);
        
        $stmt->execute(); 
    }

    /** Function does a update into studant. */
    public function update()
    {
        $sql ="UPDATE school SET `studant`(`stuenrolment`= :stuenrolment,
                 `stuname`= :stuname,
                 `stuage`= :stuage,
                 `stuaddress`= :stuaddress,
                 `stuneighborhood`= :stuneighborhood,
                 `stucity`= :stucity,
                 `stustate`= :stustate,
                 `stucountry`= :stucountry,
                 `stuzipcode`= :stuzipcode,
                 `stusponsor`= :stusponsor)
                WHERE stuenrolment = :stuenrolment)";
        
        $stmt = $pdo->prepare($sql);
        
        $stmt->bindParam(':stuname', $_POST['stuname'], PDO::PARAM_STR);
        $stmt->bindParam(':stuage', $_POST['stuage'], PDO::PARAM_STR);
        $stmt->bindParam(':stuaddress', $_POST['stuaddress'], PDO::PARAM_STR);
        $stmt->bindParam(':stuneighborhood', $_POST['stuneighborhood'], PDO::PARAM_STR);
        $stmt->bindParam(':stucity', $_POST['stucity'], PDO::PARAM_STR);
        $stmt->bindParam(':stustate', $_POST['stustate'], PDO::PARAM_STR);
        $stmt->bindParam(':stucountry', $_POST['stucountry'], PDO::PARAM_STR);
        $stmt->bindParam(':stuzipcode', $_POST['stuzipcode'], PDO::PARAM_STR);
        $stmt->bindParam(':stusponsor', $_POST['stusponsor'], PDO::PARAM_STR);
        
        $stmt->execute(); 
    }

    /** Function does a reade into studant. */
    public function reade()
    {
        $sql ="SELECT(s.idstu, s.stuenrolment, s.stuname, s.stuage,s.stuaddress,s.stuneighborhood,
                 s.stucity, s.stustate,s.stucountry, s.stuzipcode, s.stusponsor,
                 g.idgua, guaname, c.idcla, c.claname, c.claroom)
                 FROM studant s join guardian g 
                        on idstu = idgua
                     class c join studant s
                        on g.idgua = idcla;";

        
        $stmt = $pdo->prepare($sql);
        
        $stmt->bindParam(':stuenrolment', $_POST['stuenrolment'], PDO::PARAM_STR);
        $stmt->bindParam(':stuname', $_POST['stuname'], PDO::PARAM_STR);
        $stmt->bindParam(':stuage', $_POST['stuage'], PDO::PARAM_STR);
        $stmt->bindParam(':stuaddress', $_POST['stuaddress'], PDO::PARAM_STR);
        $stmt->bindParam(':stuneighborhood', $_POST['stuneighborhood'], PDO::PARAM_STR);
        $stmt->bindParam(':stucity', $_POST['stucity'], PDO::PARAM_STR);
        $stmt->bindParam(':stustate', $_POST['stustate'], PDO::PARAM_STR);
        $stmt->bindParam(':stucountry', $_POST['stucountry'], PDO::PARAM_STR);
        $stmt->bindParam(':stuzipcode', $_POST['stuzipcode'], PDO::PARAM_STR);
        $stmt->bindParam(':stusponsor', $_POST['stusponsor'], PDO::PARAM_STR);
        
        $stmt->execute(); 
    }

    /** Function does a delete into studant. */
    public function delete()
    {
        $sql = "DELETE FROM school WHERE stuenrolment =  :stuenrolment;";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':stuenrolment', $_POST['stuenrolment'], PDO::PARAM_INT);
        $stmt->execute();
    }
    /**
     * @return mixed
     */
    public function getStuenrolment()
    {
        return $this->stuenrolment;
    }

    /**
     * @return mixed
     */
    public function getStuname()
    {
        return $this->stuname;
    }

    /**
     * @return mixed
     */
    public function getStuage()
    {
        return $this->stuage;
    }

    /**
     * @return mixed
     */
    public function getStuaddress()
    {
        return $this->stuaddress;
    }

    /**
     * @return mixed
     */
    public function getStuneighborhood()
    {
        return $this->stuneighborhood;
    }

    /**
     * @return mixed
     */
    public function getStucity()
    {
        return $this->stucity;
    }

    /**
     * @return mixed
     */
    public function getStustate()
    {
        return $this->stustate;
    }

    /**
     * @return mixed
     */
    public function getStucountry()
    {
        return $this->stucountry;
    }

    /**
     * @return mixed
     */
    public function getStuzipcode()
    {
        return $this->stuzipcode;
    }

    /**
     * @return mixed
     */
    public function getStusponsor()
    {
        return $this->stusponsor;
    }

    /**
     * @param mixed $stuenrolment
     */
    public function setStuenrolment($stuenrolment)
    {
        $this->stuenrolment = $stuenrolment;
    }

    /**
     * @param mixed $stuname
     */
    public function setStuname($stuname)
    {
        $this->stuname = $stuname;
    }

    /**
     * @param mixed $stuage
     */
    public function setStuage($stuage)
    {
        $this->stuage = $stuage;
    }

    /**
     * @param mixed $stuaddress
     */
    public function setStuaddress($stuaddress)
    {
        $this->stuaddress = $stuaddress;
    }

    /**
     * @param mixed $stuneighborhood
     */
    public function setStuneighborhood($stuneighborhood)
    {
        $this->stuneighborhood = $stuneighborhood;
    }

    /**
     * @param mixed $stucity
     */
    public function setStucity($stucity)
    {
        $this->stucity = $stucity;
    }

    /**
     * @param mixed $stustate
     */
    public function setStustate($stustate)
    {
        $this->stustate = $stustate;
    }

    /**
     * @param mixed $stucountry
     */
    public function setStucountry($stucountry)
    {
        $this->stucountry = $stucountry;
    }

    /**
     * @param mixed $stuzipcode
     */
    public function setStuzipcode($stuzipcode)
    {
        $this->stuzipcode = $stuzipcode;
    }

    /**
     * @param mixed $stusponsor
     */
    public function setStusponsor($stusponsor)
    {
        $this->stusponsor = $stusponsor;
    }


    
}

