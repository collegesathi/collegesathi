<script>
var WEBSITE_URL           		= 	'{{ WEBSITE_URL }}';
var WEBSITE_IMG_URL				= 	'{{ WEBSITE_IMG_URL }}';
var csrf_token 					= 	'{{ csrf_token() }}';
var PASSWORD_REGX 				= 	/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*#?&])[A-Za-z\d$@$!%*#?&]{8,}$/;
var IMAGE_UPLOAD_FILE_MAX_SIZE 	= 	{{IMAGE_UPLOAD_FILE_MAX_SIZE}};
var IMAGE_EXTENSION   			= 	'{{IMAGE_EXTENSION}}';
var IMAGE_UPLOAD_FILE_MAX_SIZE_TWO = {{IMAGE_UPLOAD_FILE_MAX_SIZE_TWO}};
var USER_DOCUMENT_EXTENSION       	= 	'{{USER_DOCUMENT_EXTENSION}}';
var reCAPTCHASiteKey 				= 	"{{env('GOOGLE_RECAPTCHA_KEY')}}";



var ERROR_ENTER_PASSWORD = '{{ trans("messages.password.REQUIRED_ERROR") }}';
var PASSWORD_HELP_MESSAGE = '{{ trans("front_messages.front.password_help_message") }}';
var ERROR_PASSWORD_CONFIRM_PASSWORD_NOT_MATCH = '{{ trans("front_messages.global.ERROR_PASSWORD_CONFIRM_PASSWORD_NOT_MATCH") }}';
var ERROR_ENTER_VALID_EMAIL_ADDRESS = '{{ trans("messages.email.VALID_EMAIL_ERROR") }}';
var ERROR_ENTER_FIRST_NAME = '{{ trans("messages.first_name.REQUIRED_ERROR") }}';
var ERROR_ENTER_PASSWORD_MINIMUM_CHARACTERS = '{{ trans("front_messages.user.ERROR_ENTER_PASSWORD_MINIMUM_CHARACTERS") }}';
var ERROR_ENTER_LAST_NAME = '{{ trans("messages.last_name.REQUIRED_ERROR") }}';
var ERROR_ENTER_EMAIL_ADDRESS = '{{ trans("messages.email.REQUIRED_ERROR") }}';
var ERROR_ENTER_VALID_EMAIL_ADDRESS = '{{ trans("messages.email.VALID_EMAIL_ERROR") }}';
var ERROR_ENTER_MOBILE_NO = '{{ trans("messages.phone.REQUIRED_ERROR") }}';
var ERROR_ENTER_VALID_VALUE = '{{ trans("front_messages.user.ERROR_ENTER_VALID_VALUE") }}';
var ERROR_PASSWORD_REGX = '{{ trans("front_messages.password.HELP_MESSAGE") }}';
var ERROR_ENTER_FULL_NAME = '{{ trans("messages.full_name.REQUIRED_ERROR") }}';
var ERROR_SELECT_COUNTRY = '{{ trans("messages.country.REQUIRED_ERROR") }}';
var ERROR_SELECT_NATIONALITY_COUNTRY = '{{ trans("messages.nationality_country.REQUIRED_ERROR") }}';
var ERROR_SELECT_CITY = '{{ trans("messages.city.REQUIRED_ERROR") }}';
var ERROR_SELECT_STATE = '{{ trans("messages.State.REQUIRED_ERROR") }}';
var ERROR_ENTER_EMAIL_ADDRESS_LINE1 = '{{ trans("front_messages.address.ERROR_ENTER_EMAIL_ADDRESS_LINE1") }}';
var ERROR_SELECT_INDUSTRY = '{{ trans("messages.industry_id.REQUIRED_ERROR") }}';
var ERROR_SELECT_CONTACT_TYPE = '{{ trans("messages.Writer.content_type.REQUIRED_ERROR") }}';
var ERROR_ENTER_VALID_MOBILE_NUMBER = '{{ trans("front_messages.writer.ERROR_ENTER_VALID_MOBILE_NUMBER") }}';
var ERROR_ENTER_CONFIRM_PASSWORD = '{{ trans("front_messages.confirm_password.REQUIRED_ERROR") }}';
var ERROR_ENTER_SUBJECT = '{{ trans("messages.subject.REQUIRED_ERROR") }}';
var ERROR_ENTER_MESSAGE = '{{ trans("messages.comment.REQUIRED_ERROR") }}';
var ERROR_NAME_VALIDATE = '{{ trans("messages.name.VALIDATE_ERROR") }}'; 

var ERROR_ENTER_INDUSTRY = '{{ trans("messages.industry_id.REQUIRED_ERROR") }}';
var ERROR_SELECT_CONTENT_TYPE = '{{ trans("messages.content_type.REQUIRED_ERROR") }}';
var ERROR_SELECT_CONTENT_OTHER = '{{ trans("messages.other_content_text.REQUIRED_ERROR") }}';

var ERROR_COMPANY_NAME = '{{ trans("messages.company_name.REQUIRED_ERROR") }}';
var ERROR_COMPANY_ADDRESS = '{{ trans("messages.company_address.REQUIRED_ERROR") }}';
var ERROR_VALID_MOBILE_NO = '{{ trans("messages.phone.REQUIRED_VALID_ERROR") }}';
var ERROR_SELECT_PROJECT = '{{ trans("messages.project.REQUIRED_ERROR") }}';
var ERROR_SELECT_GENDER = '{{ trans("messages.gender.REQUIRED_ERROR") }}';
var ERROR_ENTER_NEW_PASSWORD = '{{ trans("messages.new_password.RQUIRED_ERROR") }}';
var ERROR_ENTER_COMMENT = '{{ trans("messages.global.REQUIRED_COMMENT_ERROR") }}';
var ERROR_ENTER_ADDRESS = '{{ trans("front_messages.address.REQUIRED_ERROR") }}';
var ERROR_SELECT_DOB = '{{ trans("front_messages.date_of_birth.REQUIRED_ERROR") }}';

var ERROR_SELECT_VERIFICATION_TYPE = '{{ trans("front_messages.verification_type.REQUIRED_ERROR") }}';
var ERROR_ENTER_PASPORT_DREIVE_NO = '{{ trans("front_messages.passport_driving_no.REQUIRED_ERROR") }}';


var ERROR_ENTER_BANK_NAME = '{{ trans("front_messages.bank_name.REQUIRED_ERROR") }}';
var ERROR_ENTER_IBAN_CODE = '{{ trans("front_messages.iban_code.REQUIRED_ERROR") }}';
var ERROR_ENTER_BIC_CODE = '{{ trans("front_messages.bic_code.REQUIRED_ERROR") }}';
var ERROR_ENTER_SWIFT_CODE = '{{ trans("front_messages.swift_code.REQUIRED_ERROR") }}';
var ERROR_ENTER_ACCOUNT_NUMBER = '{{ trans("front_messages.account_number.REQUIRED_ERROR") }}';
var ERROR_ENTER_RECIPINT_NAME = '{{ trans("front_messages.recipient_name.REQUIRED_ERROR") }}';
var ERROR_ZIP_CODE = '{{ trans("front_messages.zip_code.REQUIRED_ERROR") }}';
var IMAGE_EXTENSION_ERROR =  '{{trans("messages.image.VALID_IMAGE_ERROR", ["file_extension" => IMAGE_EXTENSION])}}';
var FILE_REQUIRED_ERROR = '{{ trans("front_messages.file.REQUIRED_ERROR") }}';

var ERROR_ENTER_FATHER_NAME = '{{ trans("messages.father_name.REQUIRE_ERROR") }}';
var ERROR_ENTER_QUALIFICATION = '{{ trans("messages.qualification.REQUIRE_ERROR") }}';
var ERROR_ENTER_SPECIFICATION = '{{ trans("messages.specifications.REQUIRE_ERROR") }}';
var ERROR_ENTER_SKILLS = '{{ trans("messages.skills.REQUIRE_ERROR") }}';
var ERROR_ENTER_EXPERANCE = '{{ trans("messages.experience.REQUIRE_ERROR") }}';
var FILE_REQUIRED_ERROR_RESUME = '{{ trans("messages.resume.REQUIRE_ERROR") }}';

var ERROR_ENTER_OLD_PASSWORD = '{{ trans("messages.old_password.REQUIRED_ERROR") }}';
var ERROR_ACCOUNT_HOLDER_NAME = '{{trans("messages.bank_holder_name.REQUIRED_ERROR")}}';
var NATIONAL_ID_COUNTRY = <?php echo json_encode( Config::get("NATIONAL_ID_COUNTRY") ); ?>;
var DL_PASSPORT_COUNTRY = <?php echo  json_encode( Config::get("DL_PASSPORT_COUNTRY") ); ?>;
var ERROR_ENTER_CARD_NAME = '{{ trans("front_messages.card.card_name") }}';
var ERROR_ENTER_CARD_NUMBER = '{{ trans("front_messages.card.card_number") }}';
var ERROR_ENTER_VALID_CARD_NUMBER = '{{ trans("front_messages.card.valid_card_number") }}';
var ERROR_ENTER_CARD_CVV = '{{ trans("front_messages.card.card_cvv") }}';
var ERROR_ENTER_CARD_VALID_CVV = '{{ trans("front_messages.card.card_valid_cvv") }}';
var ERROR_ENTER_CARD_EXPIRE_MONTHS = '{{ trans("front_messages.card.card_expire_month") }}';
var ERROR_ENTER_CARD_EXPIRE_VALID_MONTHS = '{{ trans("front_messages.card.card_valid_expire_month") }}';
var ERROR_ENTER_CARD_EXPIRE_YEAR = '{{ trans("front_messages.card.card_expire_year") }}';
var ERROR_ENTER_CARD_EXPIRE_VALID_YEAR = '{{ trans("front_messages.card.card_valid_expire_year") }}';
var ERROR_ENTER_DESCRIPTION = '{{ trans("front_messages.global.description") }}';
var ERROR_CHECKBOX = '{{ trans("messages.capture_consent.REQUIRED_ERROR") }}';
var ERROR_TERMS_CONDITIONS  = '{{ trans("front_messages.terms_conditions.REQUIRED_ERROR") }}';

var ERROR_SELECT_COURSE_TYPE = '{{ trans("front_messages.course_type.REQUIRED_ERROR") }}';
var ERROR_SELECT_COURSE = '{{ trans("front_messages.course.REQUIRE_ERROR") }}';
var ERROR_SELECT_STATE = '{{ trans("front_messages.state.REQUIRED_ERROR") }}';
// var ERROR_SELECT_CITY = '{{ trans("front_messages.city.REQUIRED_ERROR") }}';

var REQUIRED_ERROR_MESSAGE = '{{ trans("front_messages.message.REQUIRE_ERROR") }}';
var USER_FILE_EXTENSION_ERROR =  '{{trans("messages.file.VALID_IMAGE_ERROR", ["file_extension" => USER_DOCUMENT_EXTENSION])}}';

var ERROR_LINKDIN_PROFILE = '{{ trans("messages.linkedin_profile.REQUIRE_ERROR") }}';

var ERROR_SELECT_DEGREE = '{{ trans("front_messages.degree.REQUIRED_ERROR") }}';
var ERROR_SELECT_UNIVERSITY = '{{ trans("front_messages.university.REQUIRED_ERROR") }}';

var REQUIRED_ERROR_DESCRIPTION = '{{ trans("messages.description.REQUIRE_ERROR") }}';
var REQUIRED_ERROR_CV = '{{ trans("messages.upload_cv.REQUIRE_ERROR") }}';
var VALID_ERROR_CV = '{{ trans("messages.upload_cv_valid.VALID_ERROR") }}';
var ERROR_MOBILE_LENGTH = '{{ trans("messages.phone_valid_digit.VALID_ERROR") }}';
var ERROR_ENTER_MOBILE_NO_NUMERIC = '{{ trans("messages.referee_phone_valid.VALID_ERROR") }}';

var ADD_TO_COMPARE = '{{ trans("front_messages.global.add_to_compare") }}';
var ADDED_TO_COMPARE = '{{ trans("front_messages.global.added_to_compare") }}';

var RATING_REQUIRED_ERROR = '{{ trans("front_messages.ReviewRating.RATING_REQUIRED_ERROR") }}';
var REVIEW_MESSAGE_REQUIRED_ERROR = '{{ trans("front_messages.review_message.RATING_REQUIRED_ERROR") }}';
var REVIEW_MESSAGE_LENGTH = {{ json_encode(REVIEW_MESSAGE_LENGTH) }};
var REVIEW_MESSAGE_MAX_LENGTH_ERROR = '{{ trans("front_messages.ReviewRating.RATING_MAX_ERROR", ["max" => REVIEW_MESSAGE_LENGTH]) }}';

</script>
