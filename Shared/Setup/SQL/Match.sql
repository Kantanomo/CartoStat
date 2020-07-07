CREATE TABLE CS_Match(
    UUID VARCHAR(36) PRIMARY KEY,
    Variant_UUID VARCHAR(36),
    Scenario VARCHAR(50),
    FOREIGN KEY(Variant_UUID)
        REFERENCES CS_Variant(UUID)
) Engine=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;