import org.openqa.selenium.By;
import org.openqa.selenium.WebDriver;
import org.openqa.selenium.WebElement;
import org.openqa.selenium.support.ui.Select;

public class LoginAutomation {

    public static WebDriver loginEmployee(WebDriver driver) throws InterruptedException {

        WebElement emailField;
        WebElement passField;
        WebElement button;

        try {
            emailField = driver.findElement(By.xpath(".//*[@id='inputEmail3']"));
            passField  = driver.findElement(By.xpath(".//*[@id='inputPassword3']"));
            button     = driver.findElement(By.xpath(".//*[@id='signbtn']"));
        }
        catch (Exception e){
            throw e;
        }

        emailField.sendKeys("eandualem@gmail.com");
        Thread.sleep(2000);
        passField.sendKeys("Satellite");
        Thread.sleep(2000);
        button.click();
        Thread.sleep(2000);

        return driver;
    }

    public static WebDriver loginEmployer(WebDriver driver) throws InterruptedException {

        Select dropDown;
        WebElement emailField;
        WebElement passField;
        WebElement button;

        try {
            dropDown   = new Select(driver.findElement(By.xpath(".//*[@id='disabledSelect']")));
            emailField = driver.findElement(By.xpath(".//*[@id='inputEmail3']"));
            passField  = driver.findElement(By.xpath(".//*[@id='inputPassword3']"));
            button     = driver.findElement(By.xpath(".//*[@id='signbtn']"));
        }
        catch (Exception e){
            throw e;
        }
        dropDown.selectByIndex(1);

        emailField.sendKeys("eandualem@gmail.com");
        Thread.sleep(2000);
        passField.sendKeys("Satellite");
        Thread.sleep(2000);
        button.click();
        Thread.sleep(2000);


        return driver;

    }

    public static WebDriver logout(WebDriver driver) throws InterruptedException {

        WebElement button;

        try {
            button     = driver.findElement(By.xpath(".//*[@id='logout']"));
        }
        catch (Exception e){
            throw e;
        }
        button.click();

        Thread.sleep(2000);

        return driver;

    }




}
