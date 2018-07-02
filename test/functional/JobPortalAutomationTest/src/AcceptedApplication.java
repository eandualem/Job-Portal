import org.openqa.selenium.By;
import org.openqa.selenium.WebDriver;
import org.openqa.selenium.WebElement;

public class AcceptedApplication {

    public static WebDriver agree(WebDriver driver) throws InterruptedException {

        WebElement accepedMenu;
        WebElement agreeButton;

        try {
            accepedMenu     = driver.findElement(By.xpath(".//*[@id='acceptedbtn']/a"));
        }
        catch (Exception e){
            throw e;
        }

        accepedMenu.click();
        Thread.sleep(2000);


        try {
            agreeButton   = driver.findElement(By.xpath(".//*[@id='agree']/a[1]"));
        }
        catch (Exception e){
            throw e;
        }
        agreeButton.click();
        Thread.sleep(2000);

        return driver;

    }
}
