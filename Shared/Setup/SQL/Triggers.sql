DELIMITER $$
CREATE TRIGGER MatchPlayerInsert AFTER INSERT ON `CS_Player` 
    FOR EACH ROW
        begin
            DECLARE UUID_Exists Boolean;
            SELECT 1
            INTO @UUID_Exists
            FROM CS_Player
            Where CS_Player.XUID = NEW.XUID;

            IF @UUID_Exists THEN
                INSERT INTO CS_PlayerMedal (Player_XUID) VALUES(NEW.XUID);
                INSERT INTO CS_PlayerWeapon (Player_XUID) VALUES(NEW.XUID);
            END IF;
        end;
    $$
DELIMITER ;