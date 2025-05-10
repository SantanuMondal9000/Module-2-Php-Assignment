<?php

require __DIR__ . '/../vendor/autoload.php';

use PhpOffice\PhpWord\PhpWord;
use Exception;

/**
 * FormControler Class will fetch the data and file from Form.
 * Make sperate render function to provide the html structure component. 
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
  private $imagePath = NULL;

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
   private $marks;

   /**
    * Download File Path.
    *
    * @var string 
    */
    private $filePath = '';

  /**
   * The Constructor will initialize the form data and file data in class fields.
   * 
   * @param array $post_data The html form data send by user.
   * @param array $file_data The html form files send by user.
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
   * This function will upload the image in backend set the image path in class image field.
   * 
   * @param array $file_data The Form file data send by user.
   * @return void
   */
  public function imageUpload(array $file_data) {
    $target_dir = __DIR__ . "/../image/";
    $file_name = basename($file_data["image-file"]["name"]);
    $target_file = $target_dir . $file_name;

    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0755, TRUE);
    }
    if (file_exists($target_file)) {
        $this->imagePath = "../../image/" . $file_name;
    } 
    elseif (move_uploaded_file($file_data["image-file"]["tmp_name"], $target_file)) {
        $this->imagePath = "../../image/" . $file_name;
    }
  }

  /**
   * The user full name will return by this function.
   * 
   * @return string 
   */
  public function getFullName(): string {
    return $this->firstName . " " . $this->lastName;
  }

  /**
   * The Image Path will be return by this function.
   * 
   * @return string|NULL
   */
  public function getImagePath(): ?string {
    return $this->imagePath;
  }

  /**
   * User Marks will return by this function.
   * 
   * @return string   
   */
  public function getMarks(): ?string {
    return $this->marks;
  }

  /**
   * This function will create the html content and render this in html.
   * 
   * @return void
   */
  public function assignment1Render():void {
    ?><h1>Hello <?php echo htmlspecialchars($this->getFullName()); ?></h1><?php
  }

  /**
   * This function will create the html content and render this in html.
   * 
   * @return void
   */
  public function assignment2Render():void {
    ?>
      <div class="image-container">
        <?php if ($this->imagePath): ?>
            <img class="upload-image" src="<?php echo htmlspecialchars($this->imagePath); ?>" alt="Uploaded Image" width="" height="">
        <?php else: ?>
            <p>No image uploaded.</p>
        <?php endif; ?>
      </div>
    <?php
  }

  /**
   * This function will create the html content and render this in html.
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
                    <td><?php echo htmlspecialchars(trim($marksPart[0])); ?></td>
                    <td><?php echo htmlspecialchars(trim($marksPart[1])); ?></td>       
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
   * This function will create the html content and render this in html.
   * 
   * @return void
   */
  public function assignment4Render():void {
    ?><h1 class="phone-number">Phone Number:<? echo $this->phoneNumber?></h1><?php
  }

  /**
   * This function will create the html content and render this in html.
   * 
   * @return void
   */
  public function assignment5Render():void {
    ?><h1 class="email">Email:<? echo $this->email?></h1><?php
  }

  /**
   * This function will create the html content and render this in html.
   * 
   * @return void
   */
  public function assignment6Render():void {
    $this->generateDocument($this->getFullName(),$this->imagePath,$this->phoneNumber,$this->email, $this->marks);
    ?><a href="<?php echo $this->filePath ?>">Download Form Doc File</a><?php
      
  }

  /**
   * This function will fetch all the data by parameter and make a DOC file save in backend folder.
   * One download link will provide to download the DOC file.
   * 
   * @param string $full_name   The full name of the user.
   * @param string $imagePath   The path to the user's image file.
   * @param string $phoneNumber The user's phone number.
   * @param string $email       The user's email address.
   * @param string $marks       The user's marks or score.
   * @throws \Exception         Exception If an error occurs during the file generation process.
   * @return void
   */
  public function generateDocument($full_name, $imagePath, $phoneNumber, $email,$marks)
    {
      try {
        $marksLine = explode("\n", $marks);
        if (!file_exists($imagePath)) {
            throw new Exception("Image file not found: " . $imagePath);
        }

        //Make the Object and create the section.
        $phpWord = new PhpWord();
        $section = $phpWord->addSection();
        $textAlignCenter = [
            'alignment'   => \PhpOffice\PhpWord\SimpleType\Jc::CENTER
        ];

        //Add the content in Doc file.
        $section->addText("Hello $full_name", ['bold' => TRUE, 'size' => 24], $textAlignCenter);
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
          'bold'    => TRUE,
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
        $section->addText("Phone Number: $phoneNumber", ['bold' => TRUE, 'size' => 24], $textAlignCenter);
        $section->addTextBreak(1);
        $section->addText("Email: $email", ['bold' => TRUE, 'size' => 24], $textAlignCenter);
        $section->addTextBreak(1);

        //Set the directory path and save the Doc in directory.
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
