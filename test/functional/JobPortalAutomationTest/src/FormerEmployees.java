import org.openqa.selenium.By;
import org.openqa.selenium.WebDriver;
import org.openqa.selenium.WebElement;

public class FormerEmployees {

    public static WebDriver former(WebDriver driver) throws InterruptedException {

        WebElement detailButton;
        WebElement formerMenu;

        try {
            formerMenu     = driver.findElement(By.xpath(".//*[@id='formerempbtn']"));
        }
        catch (Exception e){
            throw e;
        }

        formerMenu.click();
        Thread.sleep(2000);

        try {
            detailButton     = driver.findElement(By.xpath(".//*[@id='formeremp_detail']/a[1]"));
        }
        catch (Exception e){
            throw e;
        }
        detailButton.click();
        Thread.sleep(2000);

        return driver;

    }
}
