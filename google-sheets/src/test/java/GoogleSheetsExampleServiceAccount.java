import java.io.IOException;
import java.security.GeneralSecurityException;
import java.util.Arrays;
import java.util.List;

import automation.SheetServiceUtils2;
import org.junit.BeforeClass;
import org.junit.Test;

import com.google.api.services.sheets.v4.Sheets;
import com.google.api.services.sheets.v4.model.BatchGetValuesResponse;
import com.google.api.services.sheets.v4.model.ValueRange;


public class GoogleSheetsExampleServiceAccount {

    private static Sheets sheetsService;

    // this id can be replaced with your spreadsheet id
    // otherwise be advised that multiple people may run this test and update the public spreadsheet
    private static final String SPREADSHEET_ID = "1ZAV9nsx40EZsmPr_xlYDqYBsl285hpMp0s1VKA1IBzY";

    @BeforeClass
    public static void setup() throws GeneralSecurityException, IOException {
        sheetsService = new SheetServiceUtils2().getSheetsService();
    }

    @Test
    public void whenWriteSheet_thenReadSheetOk() throws IOException {
        List<String> ranges = Arrays.asList("Sheet1!A1:A4","Sheet1!B1:B4");
        BatchGetValuesResponse readResult = sheetsService.spreadsheets().values()
                .batchGet(SPREADSHEET_ID)
                .setRanges(ranges)
                .setAccessToken(new SheetServiceUtils2().getCredentials().getAccessToken().getTokenValue())
                .execute();

        ValueRange firstColumn = readResult.getValueRanges().get(0);
        for(List<Object> values : firstColumn.getValues()){
            for(Object value : values){
                System.out.println(value.toString());
            }
        }

        ValueRange secondColumn = readResult.getValueRanges().get(1);
        for(List<Object> values : secondColumn.getValues()){
            for(Object value : values){
                System.out.println(value.toString());
            }
        }

    }
}
