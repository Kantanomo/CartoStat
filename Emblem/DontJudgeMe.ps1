$Path = "C:\Users\Mickenzie\source\repos\CartoStat\Emblem\test\";
$ImagePath = "C:\Users\Mickenzie\source\repos\CartoStat\Emblem\26281.png";

$Image = [System.Drawing.Image]::FromFile($ImagePath);
$Columns = 4;
$Rows = 16;
$ChunkWidth = 256;
$ChunkHeight = 256;

for($R = 0; $R -lt $Rows; $R++){
    for($C = 0; $C -lt $Columns; $C++){
        $CWidth = ($C * $ChunkWidth) + $C; #Each chunk has a +1 padding after 0 just add $C
        $CHeignt = ($R * $ChunkHeight) + $R;
        
        $Index = (($R * 4) + $C).ToString();
        $Chunk = New-Object System.Drawing.Bitmap -ArgumentList $ChunkWidth, $ChunkHeight;
        $Graphics = [System.Drawing.Graphics]::FromImage($Chunk);
        $RectD = New-Object System.Drawing.Rectangle -ArgumentList 0, 0, $ChunkWidth, $ChunkHeight;
        $RectS = New-Object System.Drawing.Rectangle -ArgumentList $CWidth, $CHeignt, $ChunkWidth, $ChunkHeight;
        $Graphics.DrawImage($Image, $RectD, $RectS, [System.Drawing.GraphicsUnit]::Pixel);
        $Chunk.Save($($Path + $Index + ".png"));
        $Graphics.Dispose();


        Write-Host $C "-" $R "|" $($CWidth.ToString() + " - " + $CHeignt.ToString()) "|" $Index".png";

    }
}
Write-Host $Image.Width "|" $Image.Height;