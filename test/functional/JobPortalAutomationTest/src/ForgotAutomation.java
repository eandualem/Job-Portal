import org.openqa.selenium.By;
import org.openqa.selenium.WebDriver;
import org.openqa.selenium.WebElement;

public class ForgotAutomation {

    public static WebDriver forgot(WebDriver driver) throws InterruptedException {

        WebElement emailField;
        WebElement forgotButton;
        WebElement resetButton;

        try {
            forgotButton     = driver.findElement(By.xpath(".//*[@id='forgot']/a[1]"));
        }
        catch (Exception e){
            throw e;
        }
        forgotButton.click();
        Thread.sleep(5000);

        try {
            emailField = driver.findElement(By.xpath("./html/body/div[2]/form/div/input"));
            resetButton  = driver.findElement(By.xpath("./html/body/div[2]/form/button"));
        }
        catch (Exception e){
            throw e;
        }

        emailField.sendKeys("eandualem@gmail.com");
        Thread.sleep(2000);
        resetButton.click();

        return driver;

    }
}
