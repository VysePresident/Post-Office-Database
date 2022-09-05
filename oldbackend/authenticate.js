const {JsonWebTokenError}  = require('jsonwebtoken');
const {JsonWebTokenExpiredError} = require('jsonwebtoken');
const {JsonWebTokenNotBeforeError} = require('jsonwebtoken');
const {JsonWebTokenMalformedError} = require('jsonwebtoken');
const {JsonWebTokenInvalidSignatureError} = require('jsonwebtoken');
const {JsonWebTokenInvalidIssuerError} = require('jsonwebtoken');
const {JsonWebTokenInvalidAudienceError} = require('jsonwebtoken');
const {JsonWebTokenInvalidIdError} = require('jsonwebtoken');
const {JsonWebTokenInvalidSubjectError} = require('jsonwebtoken');
const {JsonWebTokenInvalidIssuedAtError} = require('jsonwebtoken');
const {JsonWebTokenInvalidNotBeforeError} = require('jsonwebtoken');
const {JsonWebTokenInvalidExpirationError} = require('jsonwebtoken');
const {JsonWebTokenInvalidJwtSignatureError} = require('jsonwebtoken');
const {JsonWebTokenInvalidHeaderError} = require('jsonwebtoken');
const {JsonWebTokenInvalidClaimsError} = require('jsonwebtoken');

const jwt = require('jsonwebtoken');

//Token
function generateToken(user) {
    return jwt.sign(
        user,
        "SECRET",
        {expiresIn: "1h"}   //1hr
    );
}

//Verify Token
authenticateUser = (req, res, next) => {
    const header = req.headers['authorization'];
    const token = header && header.split(' ')[1];

    if (token == null) {
        return res.sendStatus(401).send("Can't find token in header");
    }
    /**
 * Asynchronously verify given token using a secret or a public key to get a decoded token
 * token - JWT string to verify
 * secretOrPublicKey - A string or buffer containing either the secret for HMAC algorithms,
 * or the PEM encoded public key for RSA and ECDSA. If jwt.verify is called asynchronous,
 * secretOrPublicKey can be a function that should fetch the secret or public key
 * [options] - Options for the verification
 * callback - Callback to get the decoded token on

export function verify(
    token: string,
    secretOrPublicKey: Secret | GetPublicKeyOrSecret,
    callback?: VerifyCallback<JwtPayload | string>,
): void;
 */
    jwt.verify(token, "SECRET", (err, user) => {
        if (err) {
            return res.sendStatus(403).send("Invalid token");
        }
        req.user = user;
        next();
    });
}

module.exports = {
    generateToken,
    authenticateUser
}