package automation;

import com.google.api.client.googleapis.javanet.GoogleNetHttpTransport;
import com.google.api.client.http.javanet.NetHttpTransport;
import com.google.api.client.json.gson.GsonFactory;
import com.google.api.services.sheets.v4.Sheets;
import com.google.api.services.sheets.v4.SheetsScopes;
import com.google.auth.oauth2.ServiceAccountCredentials;

import java.io.FileInputStream;
import java.io.IOException;
import java.io.InputStream;
import java.security.GeneralSecurityException;
import java.util.Date;
import java.util.List;
import java.util.Objects;
import java.util.concurrent.ExecutorService;
import java.util.concurrent.Executors;

public class SheetServiceUtils2 {
    private static final String APPLICATION_NAME = "Read-Sheet";

    private static final List<String> AUTH_SCOPES = List.of(SheetsScopes.SPREADSHEETS);

    private static final String RANGE = "Sheet1";

    private static final GsonFactory JSON_FACTORY = GsonFactory.getDefaultInstance();

    private static final ExecutorService executor = Executors.newSingleThreadExecutor();

    private ServiceAccountCredentials loadedCredentials;
    private Sheets loadedService;

    public SheetServiceUtils2() {
    }

    public Sheets getSheetsService() throws IOException, GeneralSecurityException {
        if (this.loadedService == null) {
            NetHttpTransport httpTransport = GoogleNetHttpTransport.newTrustedTransport();
            this.loadedService = new Sheets.Builder(httpTransport, JSON_FACTORY, request -> {
            })
                    .setApplicationName(APPLICATION_NAME)
                    .build();
        }
        return this.loadedService;
    }

    public ServiceAccountCredentials getCredentials() throws IOException {

        if (this.loadedCredentials != null) {
            if (this.loadedCredentials.getAccessToken().getExpirationTime().before(new Date())) {
                this.loadedCredentials.refresh();
            }
            return this.loadedCredentials;
        }

        try (InputStream in = SheetServiceUtils2.class.getResourceAsStream("/service-account-auth.json")) {
            this.loadedCredentials = (ServiceAccountCredentials) ServiceAccountCredentials
                    .fromStream(Objects.requireNonNull(SheetServiceUtils2.class.getResourceAsStream("/service-account-auth.json")))
                    .createScoped(AUTH_SCOPES);
            this.loadedCredentials.refresh();
            return this.loadedCredentials;
        }

    }


}

