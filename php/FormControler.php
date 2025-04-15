<?php

require __DIR__ . '/../vendor/autoload.php';

use PhpOffice\PhpWord\PhpWord;
use Exception;

/**
 * FormControler Control Assignments Render.
 * 
 */
class FormControler {

  /**
   * First Name from the form.
   *
   * @var string
   */
  private $firstName;

  /**
   * Last Name from the form.
   * 
   * @var string 
   */
  private $lastName;

  /**
   * FullName Name.
   * 
   * @var string 
   */
  private $fullName;

  /**
   * ImagePath.
   * 
   * @var string 
   */
  private $imagePath = null;

  /**
   * User Phone Number.
   * 
   * @var string 
   */
  private $phoneNumber = '';

  /**
   * User Email.
   * 
   * @var string 
   */
  private $email = ''; 

  /**
   * Subject Marks.
   * 
   * @var string 
   */
   private string $marks;

   /**
    * Download File Path.
    * @var string 
    */
    private $filePath = '';

  /**
   * Summary of __construct
   * The Form Data.
   * 
   * @param array $post_data 
   * @param array $file_data 
   */
  public function __construct(array $post_data, array $file_data) {
    $this->firstName = trim($post_data['first-name'] ?? '');
    $this->lastName = trim($post_data['last-name'] ?? '');
    $this->marks = trim($post_data['marks-area'])?? '';
    $this->phoneNumber = trim($post_data['phone-number'] ??'');
    $this->email = trim($post_data['email'] ??'');
    $this->imageUpload($file_data);
  }

  /**
   * Summary of imageUpload.
   * 
   * @param array $file_data
   * @return void
   */
  public function imageUpload(array $file_data) {
    $target_dir = __DIR__ . "/../image/";
    $file_name = basename($file_data["image-file"]["name"]);
    $target_file = $target_dir . $file_name;

    if(!is_dir($target_dir)) {
        mkdir($target_dir, 0755, true);
    }
    if(file_exists($target_file)) {
        $this->imagePath = "../../image/" . $file_name;
    } 
    elseif(move_uploaded_file($file_data["image-file"]["tmp_name"], $target_file)) {
        $this->imagePath = "../../image/" . $file_name;
    }
  }

  /**
   * The user full name.
   * 
   * @return string 
   */
  public function getFullName(): string {
    return $this->firstName . " " . $this->lastName;
  }

  /**
   * The Image Path.
   * 
   * @return string|null
   */
  public function getImagePath(): ?string {
    return $this->imagePath;
  }

  /**
   * User Marks.
   * 
   * @return string   
   */
  public function getMarks(): ?string {
    return $this->marks;
  }

  /**
   * Summary of assignment1Render.
   * 
   * @return void
   */
  public function assignment1Render():void {
    ?><h1>Hello <?php echo htmlspecialchars($this->getFullName()); ?></h1><?php
  }

  /**
   * Summary of assignment2Render.
   * 
   * @return void
   */
  public function assignment2Render():void {
    ?>
      <div class="image-container">
        <?php if ($this->imagePath): ?>
            <img src="<?php echo htmlspecialchars($this->imagePath); ?>" alt="Uploaded Image" width="500" height="500">
        <?php else: ?>
            <p>No image uploaded.</p>
        <?php endif; ?>
      </div>
    <?php
  }

  /**
   * Summary of assignment3Render.
   * 
   * @return void
   */
  public function assignment3Render():void {
    if(!empty($this->marks)) { ?>
      <table>
          <thead>
            <tr>
              <th>Subject</th>
              <th>Marks</th>
            </tr>
          </thead>
          <tbody>
            <?php 
            $marksLine = explode("\n", $this->marks);
            foreach ($marksLine as $line) {
                $marksPart = explode("|", $line);
                if (count($marksPart) == 2) {
                  ?>
                  <tr>
                    <td><?php htmlspecialchars(trim($marksPart[0])); ?></td>
                    <td><?php htmlspecialchars(trim($marksPart[1])); ?></td>
                  </tr>
                  <?php
                }
            }
              ?>
          </tbody>
      </table>
      <?php 
    }
  }

  /**
   * Summary of assignment4Render.
   * 
   * @return void
   */
  public function assignment4Render():void {
    ?><h1 class="phone-number">Phone Number:<? echo $this->phoneNumber?></h1><?php
  }

  /**
   * Summary of assignment5Render.
   * 
   * @return void
   */
  public function assignment5Render():void {
    ?><h1 class="email">Email:<? echo $this->email?></h1><?php
  }

  /**
   * Summary of assignment6Render.
   * 
   * @return void
   */
  public function assignment6Render():void {
    $this->generateDocument($this->getFullName(),$this->imagePath,$this->phoneNumber,$this->email, $this->marks);
    ?><a href="<?php echo $this->filePath ?>">Download Form Doc File</a><?php
      
  }

  /**
   * Summary of generateDocument.
   * 
   * @param string $full_name
   * @param string $imagePath
   * @param string $phoneNumber
   * @param string $email
   * @param string $marks
   * @throws \Exception
   * @return void
   */
  public function generateDocument($full_name, $imagePath, $phoneNumber, $email,$marks)
    {
      try {
        $marksLine = explode("\n", $marks);
        if (!file_exists($imagePath)) {
            throw new Exception("Image file not found: " . $imagePath);
        }

        $phpWord = new PhpWord();
        $section = $phpWord->addSection();
        $textAlignCenter = [
            'alignment'   => \PhpOffice\PhpWord\SimpleType\Jc::CENTER
        ];
        $section->addText("Hello $full_name", ['bold' => true, 'size' => 24], $textAlignCenter);
        $section->addTextBreak(1);
        $section->addImage($imagePath, [
          'width' => 300,
          'height' => 200,
          'align' => 'center'
        ]);
        $section->addTextBreak(1);
        $tableStyle = [
          'borderSize'  => 12,
          'borderColor' => 'DDDDDD',
          'cellMargin'  => 100,
          'alignment'   => \PhpOffice\PhpWord\SimpleType\JcTable::CENTER,
        ];

        $headerStyle = [
          'color'   => 'FFFFFF',
          'bold'    => true,
          'size'    => 20,
        ];

        $textStyle = ['size' => 18, 'color' => '000000'];
        $table = $section->addTable($tableStyle);
        $table->addRow();
        $table->addCell(3000, ['bgColor' => '001947'])->addText("Subject", $headerStyle);
        $table->addCell(3000, ['bgColor' => '001947'])->addText("Marks", $headerStyle);
        foreach ($marksLine as $line) {
          $marksPart = explode("|", $line);
          $table->addRow();
          $table->addCell(3000)->addText(trim($marksPart[0]), $textStyle);
          $table->addCell(3000)->addText(trim($marksPart[1]), $textStyle);
        }
        $section->addTextBreak(1);
        $section->addText("Phone Number: $phoneNumber", ['bold' => true, 'size' => 24], $textAlignCenter);
        $section->addTextBreak(1);
        $section->addText("Email: $email", ['bold' => true, 'size' => 24], $textAlignCenter);
        $section->addTextBreak(1);
        $fileName =  '../../downloads/' . $full_name . date("d-m-Y_H-i-s") . '.docx';
        $this->filePath = $fileName;

        if (!file_exists($fileName)) {
            $phpWord->save($fileName, 'Word2007');
        } 
      } 
      catch (Exception $e) {
          echo "Error: " . $e->getMessage();
      }
    }
  }
?>
