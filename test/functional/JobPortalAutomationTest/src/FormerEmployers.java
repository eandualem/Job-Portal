import org.openqa.selenium.By;
import org.openqa.selenium.WebDriver;
import org.openqa.selenium.WebElement;

public class FormerEmployers {

    public static WebDriver former(WebDriver driver) throws InterruptedException {

        WebElement formerMenu;
        WebElement formerButton;

        try {
            formerMenu     = driver.findElement(By.xpath(".//*[@id='formerbtn']/a"));
        }
        catch (Exception e){
            throw e;
        }

        formerMenu.click();
        Thread.sleep(2000);

        try {
            formerButton     = driver.findElement(By.xpath(".//*[@id='former']/a[1]"));
        }
        catch (Exception e){
            throw e;
        }
        formerButton.click();
        Thread.sleep(2000);

        return driver;

    }
}
