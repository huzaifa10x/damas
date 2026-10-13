Put the database dump here (for example damas.sql or damas.sql.gz).

MySQL imports every .sql / .sql.gz file in this folder automatically, but ONLY the first time the
database volume is created. To re-import after replacing the file:

    docker compose -f docker-compose.local.yml down -v
    docker compose -f docker-compose.local.yml up -d

The dump is ignored by git (see .gitignore) — never commit patient enquiries or admin passwords.
