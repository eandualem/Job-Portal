import org.openqa.selenium.By;
import org.openqa.selenium.WebDriver;
import org.openqa.selenium.WebElement;

public class AcceptApplied {

    public static WebDriver accept(WebDriver driver) throws InterruptedException {

        WebElement acceptButton;
        WebElement accepMenu;

        try {
            accepMenu     = driver.findElement(By.xpath(".//*[@id='applicationsbtn']"));
        }
        catch (Exception e){
            throw e;
        }

        accepMenu.click();

        try {
            acceptButton     = driver.findElement(By.xpath(".//*[@id='accept']/a[1]"));
        }
        catch (Exception e){
            throw e;
        }
        acceptButton.click();
        Thread.sleep(2000);

        return driver;

    }
}
