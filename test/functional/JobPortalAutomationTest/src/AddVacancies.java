import org.openqa.selenium.By;
import org.openqa.selenium.WebDriver;
import org.openqa.selenium.WebElement;

public class AddVacancies {

    public static WebDriver add(WebDriver driver) throws InterruptedException {


        WebElement jobName;
        WebElement skillrequired;
        WebElement minRate;
        WebElement minSalary;
        WebElement maxRate;
        WebElement maxSalary;
        WebElement numOfEmployee;
        WebElement jobType;
        WebElement description;
        WebElement addButton;


        try {

            jobName = driver.findElement(By.xpath("//*[@id='JobName']"));
            skillrequired = driver.findElement(By.xpath("//*[@id='SkillReq']"));
            minRate = driver.findElement(By.xpath("//*[@id='MinRate']"));
            minSalary = driver.findElement(By.xpath("//*[@id='MinSalary']"));
            maxRate = driver.findElement(By.xpath("//*[@id='MaxRate']"));
            maxSalary = driver.findElement(By.xpath("//*[@id='MaxSalary']"));
            numOfEmployee = driver.findElement(By.xpath("//*[@id='NoEmp']"));
            jobType = driver.findElement(By.xpath("//*[@id='Job_type_entered']"));
            description = driver.findElement(By.xpath("//*[@id='description']"));
            addButton = driver.findElement(By.xpath("//*[@id='addVacancies']"));

        }
        catch (Exception e){
            throw e;
        }

        jobName.sendKeys("Web Developer");
        skillrequired.sendKeys("Programer");
        minRate.sendKeys("100");
        minSalary.sendKeys("3000");
        maxRate.sendKeys("300");
        maxSalary.sendKeys("9000");
        numOfEmployee.sendKeys("5");
        description.sendKeys("I need new web programmer");
        addButton.click();
        Thread.sleep(2000);


        return driver;

    }
}
